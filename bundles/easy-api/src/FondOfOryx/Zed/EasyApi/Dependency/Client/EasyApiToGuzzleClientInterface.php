<?php

namespace FondOfOryx\Zed\EasyApi\Dependency\Client;

use Psr\Http\Message\ResponseInterface;

interface EasyApiToGuzzleClientInterface
{
    /**
     * @param string $method
     * @param \Psr\Http\Message\UriInterface|string $uri URI object or string.
     * @param array $options
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function request(string $method, $uri, array $options = []): ResponseInterface;
}
