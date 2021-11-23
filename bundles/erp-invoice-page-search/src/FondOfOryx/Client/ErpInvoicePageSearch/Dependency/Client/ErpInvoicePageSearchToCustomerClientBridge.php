<?php

namespace FondOfOryx\Client\ErpInvoicePageSearch\Dependency\Client;

use Generated\Shared\Transfer\CustomerTransfer;
use Spryker\Client\Customer\CustomerClientInterface;

class ErpInvoicePageSearchToCustomerClientBridge implements ErpInvoicePageSearchToCustomerClientInterface
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
