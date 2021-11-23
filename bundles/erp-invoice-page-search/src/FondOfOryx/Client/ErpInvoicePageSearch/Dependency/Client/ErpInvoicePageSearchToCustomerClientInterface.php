<?php

namespace FondOfOryx\Client\ErpInvoicePageSearch\Dependency\Client;

use Generated\Shared\Transfer\CustomerTransfer;

interface ErpInvoicePageSearchToCustomerClientInterface
{
    /**
     * @return \Generated\Shared\Transfer\CustomerTransfer|null
     */
    public function getCustomer(): ?CustomerTransfer;
}
