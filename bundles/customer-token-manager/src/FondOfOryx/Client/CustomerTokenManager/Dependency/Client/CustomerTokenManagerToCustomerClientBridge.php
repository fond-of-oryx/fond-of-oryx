<?php

namespace FondOfOryx\Client\CustomerTokenManager\Dependency\Client;

use Generated\Shared\Transfer\CustomerResponseTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Spryker\Client\Customer\CustomerClientInterface;

class CustomerTokenManagerToCustomerClientBridge implements CustomerTokenManagerToCustomerClientInterface
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
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerResponseTransfer
     */
    public function findCustomerByReference(CustomerTransfer $customerTransfer): CustomerResponseTransfer
    {
        return $this->client->findCustomerByReference($customerTransfer);
    }
}
