<?php

namespace FondOfOryx\Zed\OrderBudgetCompanyBusinessUnitConnector\Business;

use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;

interface OrderBudgetCompanyBusinessUnitConnectorFacadeInterface
{
    /**
     * Specifications:
     * - ...
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
