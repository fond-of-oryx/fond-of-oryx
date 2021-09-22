<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Expander;

use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;

interface CompanyBusinessUnitExpanderInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitTransfer $companyBusinessUnitTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitTransfer
     */
    public function expand(CompanyBusinessUnitTransfer $companyBusinessUnitTransfer): CompanyBusinessUnitTransfer;
}
