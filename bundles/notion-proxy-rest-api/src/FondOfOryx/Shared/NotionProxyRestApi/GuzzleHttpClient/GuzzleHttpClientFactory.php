<?php

namespace FondOfOryx\Shared\NotionProxyRestApi\GuzzleHttpClient;

use GuzzleHttp\Client;

class GuzzleHttpClientFactory implements GuzzleHttpClientFactoryInterface
{
    /**
     * @var \GuzzleHttp\Client
     */
    protected static $client;

    /**
     * @param array $clientConfig
     *
     * @return \GuzzleHttp\Client
     */
    public function createClient(array $clientConfig): Client
    {
        if (!static::$client) {
            static::$client = (new Client($clientConfig));
        }

        return static::$client;
    }
}
