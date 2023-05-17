<?php

namespace FondOfOryx\Shared\NotionProxyRestApi\GuzzleHttpClient;

use GuzzleHttp\Client;

class GuzzleHttpClientFactory implements GuzzleHttpClientFactoryInterface
{
    /**
     * @var \Elastica\Client
     */
    protected static $client;

    /**
     * @param array $clientConfig
     *
     * @return \Elastica\Client
     */
    public function createClient(array $clientConfig): Client
    {
        if (!static::$client) {
            static::$client = (new Client($clientConfig));
        }

        return static::$client;
    }
}
