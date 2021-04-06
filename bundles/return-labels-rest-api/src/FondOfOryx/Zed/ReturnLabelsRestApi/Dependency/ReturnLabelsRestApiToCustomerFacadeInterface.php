<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Dependency;

use Generated\Shared\Transfer\CustomerResponseTransfer;

interface ReturnLabelsRestApiToCustomerFacadeInterface
{
    /**
     * Specification:
     *  - Finds customer by reference.
     *  - Returns customer response transfer.
     *
     * @api
     *
     * @param string $customerReference
     *
     * @return \Generated\Shared\Transfer\CustomerResponseTransfer
     */
    public function findCustomerByReference(string $customerReference): CustomerResponseTransfer;
}
