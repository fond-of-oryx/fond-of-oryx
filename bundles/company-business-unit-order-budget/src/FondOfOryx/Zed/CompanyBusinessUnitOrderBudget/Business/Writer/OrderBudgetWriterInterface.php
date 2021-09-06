<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Writer;

use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;

interface OrderBudgetWriterInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitTransfer $companyBusinessUnitTransfer
     *
     * @return void
     */
    public function createForCompanyBusinessUnit(CompanyBusinessUnitTransfer $companyBusinessUnitTransfer): void;
}
