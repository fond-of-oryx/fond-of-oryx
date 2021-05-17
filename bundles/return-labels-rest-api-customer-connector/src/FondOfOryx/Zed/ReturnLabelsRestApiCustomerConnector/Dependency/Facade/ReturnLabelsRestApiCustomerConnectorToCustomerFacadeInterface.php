<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Dependency\Facade;

use Generated\Shared\Transfer\CustomerTransfer;

interface ReturnLabelsRestApiCustomerConnectorToCustomerFacadeInterface
{
    /**
     * Specification:
     * - Retrieves customer information with customer addresses and locale information by customer ID.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer|null
     */
    public function findCustomerById(CustomerTransfer $customerTransfer): ?CustomerTransfer;
}
