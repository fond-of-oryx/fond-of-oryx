<?php

namespace FondOfOryx\Zed\EasyApi\Dependency\Client;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;

interface EasyApiToGuzzleClientInterface
{
    /**
     * @param string $method
     * @param UriInterface|string $uri URI object or string.
     * @param array $options
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function request(string $method, $uri, array $options = []): ResponseInterface;
}
