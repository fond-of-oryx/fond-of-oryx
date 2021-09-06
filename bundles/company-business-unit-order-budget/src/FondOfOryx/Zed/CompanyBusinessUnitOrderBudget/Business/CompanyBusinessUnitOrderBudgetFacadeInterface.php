<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business;

use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;

interface CompanyBusinessUnitOrderBudgetFacadeInterface
{
    /**
     * Specifications:
     * - Creates order budget for given company business unit
     * - Skips if already exists
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitTransfer $companyBusinessUnitTransfer
     *
     * @return void
     */
    public function createOrderBudgetForCompanyBusinessUnit(
        CompanyBusinessUnitTransfer $companyBusinessUnitTransfer
    ): void;
}
