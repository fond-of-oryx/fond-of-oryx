<?php

namespace FondOfOryx\Zed\JellyfishCreditMemo\Business\Api\Adapter;

use FondOfOryx\Zed\JellyfishCreditMemo\Dependency\Service\JellyfishCreditMemoToUtilEncodingServiceInterface;
use FondOfOryx\Zed\JellyfishCreditMemo\Exception\ResponseErrorException;
use FondOfOryx\Zed\JellyfishCreditMemo\JellyfishCreditMemoConfig;
use Generated\Shared\Transfer\JellyfishCreditMemoTransfer;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Log\LoggerInterface;

class CreditMemoAdapter implements CreditMemoAdapterInterface
{
    /**
     * @var int
     */
    protected const SUCCESS_CODE = 200;

    /**
     * @var string
     */
    protected const CREDIT_MEMOS_URI = 'standard/credit-memos';

    /**
     * @var array
     */
    protected const DEFAULT_HEADERS = [
        'Accept' => 'application/json',
        'Content-Type' => 'application/json',
    ];

    /**
     * @var \GuzzleHttp\ClientInterface
     */
    protected $client;

    /**
     * @var \FondOfOryx\Zed\JellyfishCreditMemo\JellyfishCreditMemoConfig
     */
    protected $config;

    /**
     * @var \FondOfOryx\Zed\JellyfishCreditMemo\Dependency\Service\JellyfishCreditMemoToUtilEncodingServiceInterface
     */
    protected $utilEncodingService;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * @param \FondOfOryx\Zed\JellyfishCreditMemo\Dependency\Service\JellyfishCreditMemoToUtilEncodingServiceInterface $utilEncodingService
     * @param \GuzzleHttp\ClientInterface $client
     * @param \FondOfOryx\Zed\JellyfishCreditMemo\JellyfishCreditMemoConfig $config
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        JellyfishCreditMemoToUtilEncodingServiceInterface $utilEncodingService,
        ClientInterface $client,
        JellyfishCreditMemoConfig $config,
        LoggerInterface $logger
    ) {
        $this->utilEncodingService = $utilEncodingService;
        $this->client = $client;
        $this->config = $config;
        $this->logger = $logger;
    }

    /**
     * @param \Generated\Shared\Transfer\JellyfishCreditMemoTransfer $jellyfishCreditMemoTransfer
     *
     * @return \Psr\Http\Message\StreamInterface|null
     */
    public function sendRequest(JellyfishCreditMemoTransfer $jellyfishCreditMemoTransfer): ?StreamInterface
    {
        if ($this->config->dryRun() === true) {
            $this->logger->error($this->utilEncodingService->encodeJson($jellyfishCreditMemoTransfer->toArray(true, true)));

            return null;
        }

        $options = $this->createOptions($jellyfishCreditMemoTransfer);
        $response = $this->send($options);

        $this->handleResponse($response, $jellyfishCreditMemoTransfer);

        return $response->getBody();
    }

    /**
     * @param \Generated\Shared\Transfer\JellyfishCreditMemoTransfer $jellyfishCreditMemoTransfer
     *
     * @return array
     */
    protected function createOptions(JellyfishCreditMemoTransfer $jellyfishCreditMemoTransfer): array
    {
        $options = [];
        $username = $this->config->getUsername();
        $password = $this->config->getPassword();

        $options[RequestOptions::HEADERS] = static::DEFAULT_HEADERS;
        if ($username !== '' && $password !== '') {
            $options[RequestOptions::AUTH] = [
                $username,
                $password,
            ];
        }
        $options['timeout'] = 4;
        $options[RequestOptions::BODY] = $this->utilEncodingService->encodeJson($jellyfishCreditMemoTransfer->toArray(true, true));

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

        $this->logger->info($logMessage);

        return $this->client->request('POST', $uri, $options);
    }

    /**
     * @return string
     */
    protected function getUri(): string
    {
        return static::CREDIT_MEMOS_URI;
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param \Generated\Shared\Transfer\JellyfishCreditMemoTransfer $jellyfishCreditMemoTransfer
     *
     * @throws \FondOfOryx\Zed\JellyfishCreditMemo\Exception\ResponseErrorException
     *
     * @return void
     */
    protected function handleResponse(ResponseInterface $response, JellyfishCreditMemoTransfer $jellyfishCreditMemoTransfer): void
    {
        if ($response->getStatusCode() !== static::SUCCESS_CODE) {
            throw new ResponseErrorException('Could not send refund response to jelly');
        }
    }
}
