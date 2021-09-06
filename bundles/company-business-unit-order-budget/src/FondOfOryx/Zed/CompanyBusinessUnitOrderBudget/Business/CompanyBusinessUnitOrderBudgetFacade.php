<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business;

use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Persistence\CompanyBusinessUnitOrderBudgetEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\CompanyBusinessUnitOrderBudgetBusinessFactory getFactory()
 */
class CompanyBusinessUnitOrderBudgetFacade extends AbstractFacade implements CompanyBusinessUnitOrderBudgetFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitTransfer $companyBusinessUnitTransfer
     *
     * @return void
     */
    public function createOrderBudgetForCompanyBusinessUnit(
        CompanyBusinessUnitTransfer $companyBusinessUnitTransfer
    ): void {
        $this->getFactory()->createOrderBudgetWriter()->createForCompanyBusinessUnit($companyBusinessUnitTransfer);
    }
}
