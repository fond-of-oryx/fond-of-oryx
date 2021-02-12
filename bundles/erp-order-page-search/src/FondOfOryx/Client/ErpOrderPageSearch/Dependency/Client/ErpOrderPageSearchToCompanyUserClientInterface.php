<?php

namespace FondOfOryx\Client\ErpOrderPageSearch\Dependency\Client;

use Generated\Shared\Transfer\CompanyUserCollectionTransfer;
use Generated\Shared\Transfer\CustomerTransfer;

interface ErpOrderPageSearchToCompanyUserClientInterface
{
    /**
     * Specification:
     * - Retrieves active company users collection by customer reference.
     * - Checks activity flag in a related company and company user.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUserCollectionTransfer
     */
    public function getActiveCompanyUsersByCustomerReference(
        CustomerTransfer $customerTransfer
    ): CompanyUserCollectionTransfer;
}
