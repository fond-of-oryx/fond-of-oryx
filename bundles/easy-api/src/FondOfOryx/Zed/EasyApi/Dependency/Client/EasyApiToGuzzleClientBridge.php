<?php

namespace FondOfOryx\Zed\EasyApi\Dependency\Client;

use GuzzleHttp\ClientInterface;
use Psr\Http\Message\ResponseInterface;

class EasyApiToGuzzleClientBridge implements EasyApiToGuzzleClientInterface
{
    /**
     * @var \GuzzleHttp\ClientInterface
     */
    protected $client;

    /**
     * @param \GuzzleHttp\ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $method
     * @param \Psr\Http\Message\UriInterface|string $uri URI object or string.
     * @param array $options
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function request(string $method, $uri, array $options = []): ResponseInterface
    {
        return $this->client->request($method, $uri, $options);
    }
}
