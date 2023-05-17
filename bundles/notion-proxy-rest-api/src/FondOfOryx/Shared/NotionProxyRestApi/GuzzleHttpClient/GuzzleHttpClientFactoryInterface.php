<?php

namespace FondOfOryx\Shared\NotionProxyRestApi\GuzzleHttpClient;

use GuzzleHttp\Client;

interface GuzzleHttpClientFactoryInterface
{
    /**
     * @param array<string, mixed> $clientConfig
     *
     * @return \GuzzleHttp\Client
     */
    public function createClient(array $clientConfig): Client;
}
