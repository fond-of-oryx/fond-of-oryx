<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Reader;

use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;

interface OrderBudgetReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitTransfer $companyBusinessUnitTransfer
     *
     * @return int|null
     */
    public function getIdOrderBudgetByCompanyBusinessUnit(
        CompanyBusinessUnitTransfer $companyBusinessUnitTransfer
    ): ?int;
}
