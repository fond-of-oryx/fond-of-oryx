<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade;

use Generated\Shared\Transfer\CustomerResponseTransfer;

interface SplittableCheckoutRestApiToCustomerFacadeInterface
{
    /**
     * @param string $customerReference
     *
     * @return \Generated\Shared\Transfer\CustomerResponseTransfer
     */
    public function findCustomerByReference(string $customerReference): CustomerResponseTransfer;
}
