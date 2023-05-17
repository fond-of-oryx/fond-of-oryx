<?php

namespace FondOfOryx\Client\NotionProxyRestApi;

use FondOfOryx\Client\NotionProxyRestApi\Request\Request;
use FondOfOryx\Client\NotionProxyrestApi\Request\RequestInterface;
use FondOfOryx\Shared\NotionProxyRestApi\GuzzleHttpClient\GuzzleHttpClientFactory;
use FondOfOryx\Shared\NotionProxyRestApi\GuzzleHttpClient\GuzzleHttpClientFactoryInterface;
use GuzzleHttp\Client;
use Spryker\Client\Kernel\AbstractFactory;

/**
 * @method \FondOfOryx\Client\NotionProxyRestApi\NotionProxyRestApiConfig getConfig()
 */
class NotionProxyRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Client\NotionProxyrestApi\Request\RequestInterface
     */
    public function createRequestClient(): RequestInterface
    {
        return new Request($this->getGuzzleHttpClient());
    }

    /**
     * @return \GuzzleHttp\Client
     */
    protected function getGuzzleHttpClient(): Client
    {
        return $this->createGuzzleHttpClientFactory()->createClient(
            $this->getConfig()->getClientConfig(),
        );
    }

    /**
     * @return \FondOfOryx\Shared\NotionProxyRestApi\GuzzleHttpClient\GuzzleHttpClientFactoryInterface
     */
    protected function createGuzzleHttpClientFactory(): GuzzleHttpClientFactoryInterface
    {
        return new GuzzleHttpClientFactory();
    }
}
