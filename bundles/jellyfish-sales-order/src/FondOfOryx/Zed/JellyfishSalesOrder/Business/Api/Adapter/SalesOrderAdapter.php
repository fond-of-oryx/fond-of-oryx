<?php

namespace FondOfOryx\Zed\JellyfishSalesOrder\Business\Api\Adapter;

use Exception;
use FondOfOryx\Zed\JellyfishSalesOrder\Dependency\Service\JellyfishSalesOrderToUtilEncodingServiceInterface;
use FondOfOryx\Zed\JellyfishSalesOrder\JellyfishSalesOrderConfig;
use Generated\Shared\Transfer\JellyfishOrderTransfer;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Spryker\Shared\Log\LoggerTrait;
use Symfony\Component\HttpFoundation\Response;

class SalesOrderAdapter implements SalesOrderAdapterInterface
{
    use LoggerTrait;

    /**
     * @var array
     */
    protected const DEFAULT_HEADERS = [
        'Accept' => 'application/json',
        'Content-Type' => 'application/json',
    ];

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
     * @var \FondOfOryx\Zed\JellyfishSalesOrder\Dependency\Service\JellyfishSalesOrderToUtilEncodingServiceInterface
     */
    protected $utilEncodingService;

    /**
     * @var \GuzzleHttp\ClientInterface
     */
    protected $client;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrder\JellyfishSalesOrderConfig
     */
    protected $config;

    /**
     * @var array<\FondOfOryx\Zed\JellyfishSalesOrderExtension\Dependency\Plugin\JellyfishOrderBeforeExportPluginInterface>
     */
    protected $beforeExportPlugins;

    /**
     * @param \FondOfOryx\Zed\JellyfishSalesOrder\Dependency\Service\JellyfishSalesOrderToUtilEncodingServiceInterface $utilEncodingService
     * @param \GuzzleHttp\ClientInterface $client
     * @param \FondOfOryx\Zed\JellyfishSalesOrder\JellyfishSalesOrderConfig $config
     * @param array<\FondOfOryx\Zed\JellyfishSalesOrderExtension\Dependency\Plugin\JellyfishOrderBeforeExportPluginInterface> $beforeExportPlugins
     */
    public function __construct(
        JellyfishSalesOrderToUtilEncodingServiceInterface $utilEncodingService,
        ClientInterface $client,
        JellyfishSalesOrderConfig $config,
        array $beforeExportPlugins
    ) {
        $this->utilEncodingService = $utilEncodingService;
        $this->client = $client;
        $this->config = $config;
        $this->beforeExportPlugins = $beforeExportPlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderTransfer $jellyfishOrderTransfer
     *
     * @return \Psr\Http\Message\StreamInterface|null
     */
    public function sendRequest(JellyfishOrderTransfer $jellyfishOrderTransfer): ?StreamInterface
    {
        $options = $this->createOptions($jellyfishOrderTransfer);
        foreach ($this->beforeExportPlugins as $beforeExportPlugin) {
            $beforeExportPlugin->before($jellyfishOrderTransfer, $options);
        }

        if ($this->config->dryRun()) {
            $this->getLogger()->error($this->utilEncodingService->encodeJson($jellyfishOrderTransfer->toArray(true, true)));

            return null;
        }

        $response = $this->send($options);

        $this->handleResponse($response, $jellyfishOrderTransfer);

        return $response->getBody();
    }

    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderTransfer $jellyfishOrderTransfer
     *
     * @return array
     */
    protected function createOptions(JellyfishOrderTransfer $jellyfishOrderTransfer): array
    {
        $options = [];

        $options[RequestOptions::HEADERS] = static::DEFAULT_HEADERS;
        if (!empty($this->config->getUsername()) && !empty($this->config->getPassword())) {
            $options[RequestOptions::AUTH] = [
                $this->config->getUsername(),
                $this->config->getPassword(),
            ];
        }
        $options['timeout'] = $this->config->getTimeout();
        $options[RequestOptions::BODY] = $this->utilEncodingService->encodeJson($jellyfishOrderTransfer->toArray(true, true));

        return $options;
    }

    /**
     * @param array $options
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    protected function send(array $options = []): ResponseInterface
    {
        $uri = $this->getUri();
        $optionsAsJson = $this->utilEncodingService->encodeJson($options);
        $logMessage = sprintf('API request [%s]: %s', $uri, $optionsAsJson);

        $this->getLogger()->info($logMessage);

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
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param \Generated\Shared\Transfer\JellyfishOrderTransfer $transfer
     *
     * @throws \Exception
     *
     * @return void
     */
    protected function handleResponse(ResponseInterface $response, JellyfishOrderTransfer $transfer): void
    {
        if (in_array($response->getStatusCode(), self::VALID_CODES, true) === false) {
            throw new Exception(
                sprintf(
                    'Order export in store %s for order with id %s and reference %s failed!',
                    $transfer->getStore(),
                    $transfer->getId(),
                    $transfer->getReference(),
                ),
            );
        }
    }
}
