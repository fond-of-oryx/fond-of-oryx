<?php

namespace FondOfOryx\Zed\ErpOrder\Dependency\Facade;

use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;

interface ErpOrderToCompanyBusinessUnitFacadeInterface
{
    /**
     * Specification:
     * - Finds a company business unit by CompanyBusinessUnitTransfer::idCompanyBusinessUnit in the transfer
     * - Executes company business unit transfer expander plugins
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitTransfer $companyBusinessUnitTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitTransfer
     */
    public function getCompanyBusinessUnitById(
        CompanyBusinessUnitTransfer $companyBusinessUnitTransfer
    ): CompanyBusinessUnitTransfer;
}
