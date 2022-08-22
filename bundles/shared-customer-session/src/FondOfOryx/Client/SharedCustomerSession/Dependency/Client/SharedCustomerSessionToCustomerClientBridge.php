<?php

namespace FondOfOryx\Client\SharedCustomerSession\Dependency\Client;

use Generated\Shared\Transfer\CustomerResponseTransfer;
use Spryker\Client\Customer\CustomerClientInterface;

class SharedCustomerSessionToCustomerClientBridge implements SharedCustomerSessionToCustomerClientInterface
{
    /**
     * @var \Spryker\Client\Customer\CustomerClientInterface
     */
    private $client;

    /**
     * @param \Spryker\Client\Customer\CustomerClientInterface $client
     */
    public function __construct(CustomerClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $accessToken
     *
     * @return \Generated\Shared\Transfer\CustomerResponseTransfer
     */
    public function getCustomerByAccessToken(string $accessToken): CustomerResponseTransfer
    {
        return $this->client->getCustomerByAccessToken($accessToken);
    }
}
