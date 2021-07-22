<?php

namespace FondOfOryx\Zed\JellyfishBuffer\Business\Export;

use Exception;
use FondOfOryx\Zed\JellyfishBuffer\JellyfishBufferConfig;
use FondOfOryx\Zed\JellyfishBuffer\Persistence\JellyfishBufferEntityManagerInterface;
use FondOfOryx\Zed\JellyfishBuffer\Persistence\JellyfishBufferRepositoryInterface;
use Generated\Shared\Transfer\ExportedOrderTransfer;
use Generated\Shared\Transfer\JellyfishBufferTableFilterTransfer;
use GuzzleHttp\ClientInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;

class OrderExport implements DataExportInterface
{
    protected const ORDERS_URI = 'standard/orders';

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
     * @param \Generated\Shared\Transfer\JellyfishBufferTableFilterTransfer $jellyfishBufferTableFilterTransfer
     *
     * @return bool
     */
    public function export(JellyfishBufferTableFilterTransfer $jellyfishBufferTableFilterTransfer): bool
    {
        $errors = false;
        $this->validateFilter($jellyfishBufferTableFilterTransfer);

        $collection = $this->repository->findBufferedOrders($jellyfishBufferTableFilterTransfer);

        $message = sprintf('Exporting %s orders from buffer table for store %s with system code override %s', $collection->getCount(), $jellyfishBufferTableFilterTransfer->getStore(), $jellyfishBufferTableFilterTransfer->getSystemCode());
        $this->logger->notice($message);
        echo $message . PHP_EOL;

        foreach ($collection->getOrders() as $order) {
            $data = $this->prepareOverride($order, $jellyfishBufferTableFilterTransfer);
            if ($jellyfishBufferTableFilterTransfer->getDryRun() === true) {
                //Attention: this writes customer data to log!
                $dataString = json_encode($data);
                $this->logger->notice(sprintf(
                    'ID: %s, OrderRef %s, SalesOrderId: %s, Data: %s',
                    $order->getIdExportedOrder(),
                    $order->getOrderReference(),
                    $order->getFkSalesOrder(),
                    $dataString
                ));
                echo $dataString . PHP_EOL;

                continue;
            }
            $response = $this->send($this->getUri(), $data);

            if (in_array($response->getStatusCode(), static::VALID_CODES, true) === false) {
                $errors = true;
                $this->logger->error(sprintf(
                    'Export error with error code "%s" for order data ID: %s, OrderRef: %s, SalesOrderId: %s',
                    $response->getStatusCode(),
                    $order->getIdExportedOrder(),
                    $order->getOrderReference(),
                    $order->getFkSalesOrder()
                ));
            } else {
                $this->em->flagAsReexported($order->getFkSalesOrder());
            }
        }

        return $errors;
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
     * @return array
     */
    protected function prepareOverride(
        ExportedOrderTransfer $exportedOrderTransfer,
        JellyfishBufferTableFilterTransfer $jellyfishBufferTableFilterTransfer
    ): array {
        $data = json_decode($exportedOrderTransfer->getData(), true);
        if (empty($jellyfishBufferTableFilterTransfer->getSystemCode()) === true) {
            return $data;
        }

        return $this->overrideSystemCode($data, $jellyfishBufferTableFilterTransfer);
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
