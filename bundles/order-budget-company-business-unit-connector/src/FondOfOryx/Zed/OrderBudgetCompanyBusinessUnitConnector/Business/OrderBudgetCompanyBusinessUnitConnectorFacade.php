<?php

namespace FondOfOryx\Zed\OrderBudgetCompanyBusinessUnitConnector\Business;

use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\OrderBudgetCompanyBusinessUnitConnector\Persistence\OrderBudgetCompanyBusinessUnitConnectorEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\OrderBudgetCompanyBusinessUnitConnector\Business\OrderBudgetCompanyBusinessUnitConnectorBusinessFactory getFactory()
 */
class OrderBudgetCompanyBusinessUnitConnectorFacade extends AbstractFacade implements OrderBudgetCompanyBusinessUnitConnectorFacadeInterface
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
