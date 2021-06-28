<?php

namespace FondOfOryx\Zed\JellyfishCreditMemo\Business\Api\Adapter;

use FondOfOryx\Zed\JellyfishCreditMemo\Dependency\Service\JellyfishCreditMemoToUtilEncodingServiceInterface;
use FondOfOryx\Zed\JellyfishCreditMemo\Exception\ResponseErrorException;
use FondOfOryx\Zed\JellyfishCreditMemo\JellyfishCreditMemoConfig;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Shared\Log\LoggerTrait;

class CreditMemoAdapter implements CreditMemoAdapterInterface
{
    use LoggerTrait;

    protected const SUCCESS_CODE = 200;

    protected const CREDIT_MEMOS_URI = 'standard/credit-memos';

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
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var bool
     */
    protected $dryRun;

    /**
     * @param \FondOfOryx\Zed\JellyfishCreditMemo\Dependency\Service\JellyfishCreditMemoToUtilEncodingServiceInterface $utilEncodingService
     * @param \GuzzleHttp\ClientInterface $client
     * @param \FondOfOryx\Zed\JellyfishCreditMemo\JellyfishCreditMemoConfig $config
     */
    public function __construct(
        JellyfishCreditMemoToUtilEncodingServiceInterface $utilEncodingService,
        ClientInterface $client,
        JellyfishCreditMemoConfig $config
    ) {
        $this->utilEncodingService = $utilEncodingService;
        $this->client = $client;

        $this->config = $config;
        $this->username = $config->getUsername();
        $this->password = $config->getPassword();
        $this->dryRun = $config->dryRun();
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $transfer
     *
     * @return \Psr\Http\Message\StreamInterface|null
     */
    public function sendRequest(AbstractTransfer $transfer): ?StreamInterface
    {
        if ($this->dryRun === true) {
            $this->getLogger()->error($this->utilEncodingService->encodeJson($transfer->toArray(true, true)));

            return null;
        }

        $options = $this->createOptions($transfer);
        $response = $this->send($options);

        $this->handleResponse($response, $transfer);

        return $response->getBody();
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $transfer
     *
     * @return array
     */
    protected function createOptions(AbstractTransfer $transfer): array
    {
        $options = [];

        $options[RequestOptions::HEADERS] = static::DEFAULT_HEADERS;
        if (!empty($this->username) && !empty($this->password)) {
            $options[RequestOptions::AUTH] = [
                $this->username,
                $this->password,
            ];
        }
        $options['timeout'] = 4;
        $options[RequestOptions::BODY] = $this->utilEncodingService->encodeJson($transfer->toArray(true, true));

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
        return static::CREDIT_MEMOS_URI;
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $transfer
     *
     * @throws \FondOfOryx\Zed\JellyfishCreditMemo\Exception\ResponseErrorException
     *
     * @return void
     */
    protected function handleResponse(ResponseInterface $response, AbstractTransfer $transfer): void
    {
        if ($response->getStatusCode() !== static::SUCCESS_CODE) {
            throw new ResponseErrorException('Could not send refund response to jelly');
        }
    }
}
