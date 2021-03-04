<?php

namespace FondOfOryx\Client\ErpOrderPageSearch\Dependency\Client;

use Generated\Shared\Transfer\CustomerTransfer;
use Spryker\Client\Customer\CustomerClientInterface;

class ErpOrderPageSearchToCustomerClientBridge implements ErpOrderPageSearchToCustomerClientInterface
{
    /**
     * @var \Spryker\Client\Customer\CustomerClientInterface
     */
    protected $client;

    /**
     * @param \Spryker\Client\Customer\CustomerClientInterface $client
     */
    public function __construct(CustomerClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @return \Generated\Shared\Transfer\CustomerTransfer|null
     */
    public function getCustomer(): ?CustomerTransfer
    {
        return $this->client->getCustomer();
    }
}
