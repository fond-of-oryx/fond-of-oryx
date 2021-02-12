<?php

namespace FondOfOryx\Client\ErpOrderPageSearch\Dependency\Client;

use Spryker\Client\Session\SessionClientInterface;

class ErpOrderPageSearchToSessionClientBridge implements ErpOrderPageSearchToSessionClientInterface
{
    /**
     * @var \Spryker\Client\Session\SessionClientInterface
     */
    protected $client;

    /**
     * @param \Spryker\Client\Session\SessionClientInterface $client
     */
    public function __construct(SessionClientInterface $client)
    {
        $this->client = $client;
    }
}
