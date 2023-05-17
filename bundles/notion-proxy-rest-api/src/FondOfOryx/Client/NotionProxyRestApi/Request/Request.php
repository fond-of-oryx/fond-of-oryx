<?php

namespace FondOfOryx\Client\NotionProxyRestApi\Request;

use Exception;
use Generated\Shared\Transfer\RestNotionProxyRequestAttributesTransfer;
use Generated\Shared\Transfer\RestNotionProxyRequestResponseTransfer;
use GuzzleHttp\Client;

class Request implements RequestInterface
{
    /**
     * @var string
     */
    protected const STATUS_CODE_ERROR = '429';

    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * @param \GuzzleHttp\Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
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
                $this->getUri($restNotionProxyRequestAttributesTransfer),
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
     * @return string
     */
    protected function getUri(
        RestNotionProxyRequestAttributesTransfer $restNotionProxyRequestAttributesTransfer
    ): string {
        $uri = $restNotionProxyRequestAttributesTransfer->getObject();

        if ($restNotionProxyRequestAttributesTransfer->getId()) {
            $uri = $uri . '/' . $restNotionProxyRequestAttributesTransfer->getId();
        }

        return $uri;
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
            $options['json'] = $restNotionProxyRequestAttributesTransfer->getData();
        }

        return $options;
    }
}
