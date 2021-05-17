<?php

namespace FondOfOryx\Zed\ReturnLabel\Business\Api\Adapter;

use FondOfOryx\Zed\ReturnLabel\Dependency\Service\ReturnLabelToUtilEncodingServiceInterface;
use FondOfOryx\Zed\ReturnLabel\ReturnLabelConfig;
use GuzzleHttp\ClientInterface as HttpClientInterface;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use RuntimeException;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;

class ReturnLabelAdapter implements ReturnLabelAdapterInterface
{
    protected const POST = 'post';
    protected const RESOURCE_PATH = 'standard/return-labels';

    /**
     * @var \GuzzleHttp\ClientInterface
     */
    protected $httpClient;

    /**
     * @var \FondOfOryx\Zed\ReturnLabel\ReturnLabelConfig
     */
    protected $config;

    /**
     * @var \FondOfOryx\Zed\ReturnLabel\Dependency\Service\ReturnLabelToUtilEncodingServiceInterface
     */
    protected $utilEncodingService;

    /**
     * @param \GuzzleHttp\ClientInterface $httpClient
     * @param \FondOfOryx\Zed\ReturnLabel\ReturnLabelConfig $config
     * @param \FondOfOryx\Zed\ReturnLabel\Dependency\Service\ReturnLabelToUtilEncodingServiceInterface $utilEncodingService
     */
    public function __construct(
        HttpClientInterface $httpClient,
        ReturnLabelConfig $config,
        ReturnLabelToUtilEncodingServiceInterface $utilEncodingService
    ) {
        $this->httpClient = $httpClient;
        $this->config = $config;
        $this->utilEncodingService = $utilEncodingService;
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $transfer
     *
     * @throws \RuntimeException
     *
     * @return \Psr\Http\Message\StreamInterface|null
     */
    public function sendRequest(AbstractTransfer $transfer): ?StreamInterface
    {
        $options = $this->createOptions($transfer);
        $response = $this->send($options);

        if ($response->getStatusCode() !== 200) {
            throw new RuntimeException();
        }

        return $response->getBody();
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $transfer
     *
     * @return array
     */
    protected function createOptions(AbstractTransfer $transfer): array
    {
        $options = [
            RequestOptions::HEADERS => $this->config->getApiRequestHeader(),
            RequestOptions::TIMEOUT => $this->config->getApiRequestTimeout(),
            RequestOptions::BODY => $this->utilEncodingService->encodeJson(
                $transfer->toArray(true, true)
            ),
        ];

        if ($this->config->getApiUsername() === null && $this->config->getApiPassword() === null) {
            return $options;
        }

        $options[RequestOptions::AUTH] = [$this->config->getApiUsername(), $this->config->getApiPassword()];

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

        return $this->httpClient->request(static::POST, $uri, $options);
    }

    /**
     * @return string
     */
    protected function getUri(): string
    {
        return sprintf('%s/%s', rtrim($this->config->getApiBaseUri(), '/'), static::RESOURCE_PATH);
    }
}
