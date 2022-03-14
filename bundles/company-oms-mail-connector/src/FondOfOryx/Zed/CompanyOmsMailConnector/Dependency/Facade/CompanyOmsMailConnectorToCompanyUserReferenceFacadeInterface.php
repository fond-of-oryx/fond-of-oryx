<?php

namespace FondOfOryx\Zed\CompanyOmsMailConnector\Dependency\Facade;

use Generated\Shared\Transfer\CompanyUserResponseTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;

interface CompanyOmsMailConnectorToCompanyUserReferenceFacadeInterface
{
    /**
     * Specifications:
     *  - Finds company user by reference.
     *  - Returns company user response transfer.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CompanyUserTransfer $companyUserTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUserResponseTransfer
     */
    public function findCompanyUserByCompanyUserReference(
        CompanyUserTransfer $companyUserTransfer
    ): CompanyUserResponseTransfer;
}
