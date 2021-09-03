<?php

namespace FondOfOryx\Zed\OrderBudgetCompanyBusinessUnitConnector\Business;

use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;

interface OrderBudgetCompanyBusinessUnitConnectorFacadeInterface
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
