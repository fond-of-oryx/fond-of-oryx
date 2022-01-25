<?php

namespace FondOfOryx\Zed\JellyfishBuffer\Business\Export;

use Exception;
use FondOfOryx\Zed\JellyfishBuffer\JellyfishBufferConfig;
use FondOfOryx\Zed\JellyfishBuffer\Persistence\JellyfishBufferEntityManagerInterface;
use FondOfOryx\Zed\JellyfishBuffer\Persistence\JellyfishBufferRepositoryInterface;
use Generated\Shared\Transfer\ExportedOrderConfigTransfer;
use Generated\Shared\Transfer\ExportedOrderHistoryTransfer;
use Generated\Shared\Transfer\ExportedOrderTransfer;
use Generated\Shared\Transfer\JellyfishBufferTableFilterTransfer;
use Generated\Shared\Transfer\UserTransfer;
use GuzzleHttp\ClientInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;

class OrderExport implements DataExportInterface
{
    /**
     * @var string
     */
    protected const ORDERS_URI = 'standard/orders';

    /**
     * @var array
     */
    protected const VALID_CODES = [
        Response::HTTP_OK,
        Response::HTTP_CREATED,
        Response::HTTP_ACCEPTED,
    ];

    /**
     * @var \FondOfOryx\Zed\JellyfishBuffer\Persistence\JellyfishBufferRepositoryInterface
     */
    protected $repository;

    /**
     * @var \FondOfOryx\Zed\JellyfishBuffer\Persistence\JellyfishBufferEntityManagerInterface
     */
    protected $em;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * @var \GuzzleHttp\ClientInterface
     */
    protected $client;

    /**
     * @var \FondOfOryx\Zed\JellyfishBuffer\JellyfishBufferConfig
     */
    protected $config;

    /**
     * @param \FondOfOryx\Zed\JellyfishBuffer\Persistence\JellyfishBufferRepositoryInterface $repository
     * @param \FondOfOryx\Zed\JellyfishBuffer\Persistence\JellyfishBufferEntityManagerInterface $em
     * @param \Psr\Log\LoggerInterface $logger
     * @param \GuzzleHttp\ClientInterface $client
     * @param \FondOfOryx\Zed\JellyfishBuffer\JellyfishBufferConfig $config
     */
    public function __construct(
        JellyfishBufferRepositoryInterface $repository,
        JellyfishBufferEntityManagerInterface $em,
        LoggerInterface $logger,
        ClientInterface $client,
        JellyfishBufferConfig $config
    ) {
        $this->repository = $repository;
        $this->em = $em;
        $this->logger = $logger;
        $this->client = $client;
        $this->config = $config;
    }

    /**
     * @param \Generated\Shared\Transfer\ExportedOrderConfigTransfer $configTransfer
     *
     * @return bool
     */
    public function exportByFilter(ExportedOrderConfigTransfer $configTransfer): bool
    {
        $configTransfer->requireFilter();
        $jellyfishBufferTableFilterTransfer = $configTransfer->getFilter();
        $errors = false;
        $this->validateFilter($jellyfishBufferTableFilterTransfer);

        $collection = $this->repository->findBufferedOrders($jellyfishBufferTableFilterTransfer);

        $message = sprintf(
            'Exporting "%s" orders from buffer table for store "%s" with system code override "%s"',
            $collection->getCount(),
            $jellyfishBufferTableFilterTransfer->getStore(),
            $jellyfishBufferTableFilterTransfer->getSystemCode(),
        );
        $this->logger->notice($message);
        echo $message . PHP_EOL;

        foreach ($collection->getOrders() as $order) {
            $order = $this->prepareOverride($order, $jellyfishBufferTableFilterTransfer);
            if ($this->export($order, $configTransfer) === false) {
                $errors = true;
            }
        }

        return $errors;
    }

    /**
     * @param \Generated\Shared\Transfer\ExportedOrderTransfer $exportedOrderTransfer
     * @param \Generated\Shared\Transfer\ExportedOrderConfigTransfer $configTransfer
     *
     * @return bool
     */
    public function export(ExportedOrderTransfer $exportedOrderTransfer, ExportedOrderConfigTransfer $configTransfer): bool
    {
        $this->em->createHistoryEntry($this->createHistoryEntryTransfer($exportedOrderTransfer, $configTransfer));

        if ($this->config->getDryRun() === true || $this->isDryRunByFilter($configTransfer->getFilter()) === true) {
            //Attention: this writes customer data to log!
            $this->logger->notice(sprintf(
                'ID: %s, OrderRef %s, SalesOrderId: %s, Data: %s',
                $exportedOrderTransfer->getIdExportedOrder(),
                $exportedOrderTransfer->getOrderReference(),
                $exportedOrderTransfer->getFkSalesOrder(),
                $exportedOrderTransfer->getData(),
            ));

            return true;
        }
        $response = $this->send($this->getUri(), json_decode($exportedOrderTransfer->getData(), true));

        if (in_array($response->getStatusCode(), static::VALID_CODES, true) === false) {
            $this->logger->error(sprintf(
                'Export error with error code "%s" for order data ID: %s, OrderRef: %s, SalesOrderId: %s',
                $response->getStatusCode(),
                $exportedOrderTransfer->getIdExportedOrder(),
                $exportedOrderTransfer->getOrderReference(),
                $exportedOrderTransfer->getFkSalesOrder(),
            ));

            return false;
        }

        $this->em->flagAsReexported($exportedOrderTransfer->getFkSalesOrder());

        return true;
    }

    /**
     * @param \Generated\Shared\Transfer\JellyfishBufferTableFilterTransfer|null $jellyfishBufferTableFilterTransfer
     *
     * @return bool
     */
    protected function isDryRunByFilter(?JellyfishBufferTableFilterTransfer $jellyfishBufferTableFilterTransfer): bool
    {
        if ($jellyfishBufferTableFilterTransfer === null) {
            return false;
        }

        return $jellyfishBufferTableFilterTransfer->getDryRun() === true;
    }

    /**
     * @param \Generated\Shared\Transfer\ExportedOrderTransfer $exportedOrderTransfer
     * @param \Generated\Shared\Transfer\ExportedOrderConfigTransfer $configTransfer
     *
     * @return \Generated\Shared\Transfer\ExportedOrderHistoryTransfer
     */
    protected function createHistoryEntryTransfer(
        ExportedOrderTransfer $exportedOrderTransfer,
        ExportedOrderConfigTransfer $configTransfer
    ): ExportedOrderHistoryTransfer {
        $configTransfer->requireUser();

        $exportedOrderHistoryTransfer = (new ExportedOrderHistoryTransfer())->fromArray($exportedOrderTransfer->toArray(), true);
        $exportedOrderHistoryTransfer
            ->setFkExportedOrder($exportedOrderTransfer->getIdExportedOrder())
            ->setFkUser($configTransfer->getUser()->getIdUser());
        $configTransfer->setUser((new UserTransfer())->setIdUser($configTransfer->getUser()->getIdUser()));
        $exportedOrderHistoryTransfer->setConfig(json_encode($configTransfer->toArray()));

        return $exportedOrderHistoryTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\JellyfishBufferTableFilterTransfer $jellyfishBufferTableFilterTransfer
     *
     * @throws \Exception
     *
     * @return void
     */
    protected function validateFilter(JellyfishBufferTableFilterTransfer $jellyfishBufferTableFilterTransfer): void
    {
        if (empty($jellyfishBufferTableFilterTransfer->getStore())) {
            throw new Exception('Store in filter is required!');
        }
        if (
            empty($jellyfishBufferTableFilterTransfer->getIds())
            && ($jellyfishBufferTableFilterTransfer->getRangeTo() === null || $jellyfishBufferTableFilterTransfer->getRangeFrom() === null)
        ) {
            throw new Exception('Array of IDs or range from and range to has to be set!');
        }
    }

    /**
     * @param \Generated\Shared\Transfer\ExportedOrderTransfer $exportedOrderTransfer
     * @param \Generated\Shared\Transfer\JellyfishBufferTableFilterTransfer $jellyfishBufferTableFilterTransfer
     *
     * @return \Generated\Shared\Transfer\ExportedOrderTransfer
     */
    protected function prepareOverride(
        ExportedOrderTransfer $exportedOrderTransfer,
        JellyfishBufferTableFilterTransfer $jellyfishBufferTableFilterTransfer
    ): ExportedOrderTransfer {
        $data = json_decode($exportedOrderTransfer->getData(), true);
        if (empty($jellyfishBufferTableFilterTransfer->getSystemCode()) === true) {
            return $exportedOrderTransfer;
        }

        return $exportedOrderTransfer->setData(json_encode($this->overrideSystemCode($data, $jellyfishBufferTableFilterTransfer)));
    }

    /**
     * @param string $uri
     * @param array $options
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    protected function send(string $uri, array $options): ResponseInterface
    {
        return $this->client->request('POST', $uri, $options);
    }

    /**
     * @return string
     */
    protected function getUri(): string
    {
        return sprintf('%s/%s', rtrim($this->config->getBaseUri(), '/'), static::ORDERS_URI);
    }

    /**
     * @param array $data
     * @param \Generated\Shared\Transfer\JellyfishBufferTableFilterTransfer $jellyfishBufferTableFilterTransfer
     *
     * @return array
     */
    protected function overrideSystemCode(array $data, JellyfishBufferTableFilterTransfer $jellyfishBufferTableFilterTransfer)
    {
        $body = json_decode($data['body'], true);
        $body['systemCode'] = $jellyfishBufferTableFilterTransfer->getSystemCode();
        $data['body'] = json_encode($body);

        return $data;
    }
}
