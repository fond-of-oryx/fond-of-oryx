<?php

namespace FondOfOryx\Client\NotionProxyRestApi\Request;

use Exception;
use Generated\Shared\Transfer\RestNotionProxyRequestAttributesTransfer;
use Generated\Shared\Transfer\RestNotionProxyRequestResponseTransfer;
use GuzzleHttp\Client;
use Psr\Log\LoggerInterface;

class Request implements RequestInterface
{
    /**
     * @var int
     */
    protected const STATUS_CODE_ERROR = 429;

    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected LoggerInterface $logger;

    /**
     * @param \GuzzleHttp\Client $client
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(Client $client, LoggerInterface $logger)
    {
        $this->client = $client;
        $this->logger = $logger;
    }

    /**
     * @param \Generated\Shared\Transfer\RestNotionProxyRequestAttributesTransfer $restNotionProxyRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestNotionProxyRequestResponseTransfer
     */
    public function send(
        RestNotionProxyRequestAttributesTransfer $restNotionProxyRequestAttributesTransfer
    ): RestNotionProxyRequestResponseTransfer {
        $restNotionProxyRequestResponseTransfer = new RestNotionProxyRequestResponseTransfer();

        try {
            $response = $this->client->request(
                $restNotionProxyRequestAttributesTransfer->getMethod(),
                $restNotionProxyRequestAttributesTransfer->getPath(),
                $this->getOptions($restNotionProxyRequestAttributesTransfer),
            );
        } catch (Exception $e) {
            return $restNotionProxyRequestResponseTransfer
                ->setStatus(static::STATUS_CODE_ERROR)
                ->setErrors([$e->getMessage()]);
        }

        return $restNotionProxyRequestResponseTransfer
            ->setStatus($response->getStatusCode())
            ->setData(json_decode($response->getBody()->getContents()));
    }

    /**
     * @param \Generated\Shared\Transfer\RestNotionProxyRequestAttributesTransfer $restNotionProxyRequestAttributesTransfer
     *
     * @return array<string, mixed>
     */
    protected function getOptions(
        RestNotionProxyRequestAttributesTransfer $restNotionProxyRequestAttributesTransfer
    ): array {
        $options = [];

        if ($restNotionProxyRequestAttributesTransfer->getData()) {
            try {
                $options['json'] = json_decode($restNotionProxyRequestAttributesTransfer->getData(), true, 512, JSON_THROW_ON_ERROR);
            } catch (Exception $e) {
                $this->logger->error('NotionProxyRestApi: Error while decoding data: ' . $restNotionProxyRequestAttributesTransfer->getData());
                $this->logger->error($e->getMessage(), $e->getTrace());
            }
        }

        return $options;
    }
}
