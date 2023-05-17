<?php

namespace FondOfOryx\Shared\NotionProxyRestApi\GuzzleHttpClient;

use GuzzleHttp\Client;

interface GuzzleHttpClientFactoryInterface
{
    /**
     * @param array $clientConfig
     *
     * @return \GuzzleHttp\Client
     */
    public function createClient(array $clientConfig): Client;
}
