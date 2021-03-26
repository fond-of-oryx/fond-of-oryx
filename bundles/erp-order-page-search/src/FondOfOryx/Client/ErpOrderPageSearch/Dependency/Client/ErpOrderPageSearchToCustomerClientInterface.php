<?php

namespace FondOfOryx\Client\ErpOrderPageSearch\Dependency\Client;

use Generated\Shared\Transfer\CustomerTransfer;

interface ErpOrderPageSearchToCustomerClientInterface
{
    /**
     * @return \Generated\Shared\Transfer\CustomerTransfer|null
     */
    public function getCustomer(): ?CustomerTransfer;
}
