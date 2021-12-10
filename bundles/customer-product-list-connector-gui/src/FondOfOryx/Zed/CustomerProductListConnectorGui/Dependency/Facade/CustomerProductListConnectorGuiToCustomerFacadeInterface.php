<?php

namespace FondOfOryx\Zed\CustomerProductListConnectorGui\Dependency\Facade;

use Generated\Shared\Transfer\CustomerTransfer;

interface CustomerProductListConnectorGuiToCustomerFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer|null
     */
    public function findCustomerById(CustomerTransfer $customerTransfer): ?CustomerTransfer;
}
