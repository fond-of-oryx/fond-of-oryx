<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Persistence;

use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;

interface CompanyBusinessUnitOrderBudgetEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitTransfer $companyBusinessUnitTransfer
     *
     * @return void
     */
    public function assignOrderBudgetToCompanyBusinessUnit(
        CompanyBusinessUnitTransfer $companyBusinessUnitTransfer
    ): void;
}
