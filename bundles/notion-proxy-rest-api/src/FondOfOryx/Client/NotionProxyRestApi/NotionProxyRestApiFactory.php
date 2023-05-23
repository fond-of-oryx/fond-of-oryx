<?php

namespace FondOfOryx\Client\NotionProxyRestApi;

use FondOfOryx\Client\NotionProxyRestApi\Request\Request;
use FondOfOryx\Client\NotionProxyRestApi\Request\RequestInterface;
use GuzzleHttp\Client;
use Spryker\Client\Kernel\AbstractFactory;

/**
 * @method \FondOfOryx\Client\NotionProxyRestApi\NotionProxyRestApiConfig getConfig()
 */
class NotionProxyRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Client\NotionProxyRestApi\Request\RequestInterface
     */
    public function createRequestClient(): RequestInterface
    {
        return new Request($this->createGuzzleClient());
    }

    /**
     * @return \GuzzleHttp\Client
     */
    protected function createGuzzleClient(): Client
    {
        return new Client(
            $this->getConfig()->getClientConfig(),
        );
    }
}
