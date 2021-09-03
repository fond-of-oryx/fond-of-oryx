<?php

namespace FondOfOryx\Zed\OrderBudgetCompanyBusinessUnitConnector\Persistence;

use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\SpyCompanyBusinessUnitEntityTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \FondOfOryx\Zed\OrderBudgetCompanyBusinessUnitConnector\Persistence\OrderBudgetCompanyBusinessUnitConnectorPersistenceFactory getFactory()
 */
class OrderBudgetCompanyBusinessUnitConnectorEntityManager extends AbstractEntityManager implements
    OrderBudgetCompanyBusinessUnitConnectorEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitTransfer $companyBusinessUnitTransfer
     *
     * @return void
     */
    public function assignOrderBudgetToCompanyBusinessUnit(
        CompanyBusinessUnitTransfer $companyBusinessUnitTransfer
    ): void {
        $companyBusinessUnitTransfer->requireIdCompanyBusinessUnit();
        $companyBusinessUnitTransfer->requireFkOrderBudget();

        $idCompanyBusinessUnit = $companyBusinessUnitTransfer->getIdCompanyBusinessUnit();
        $fkOrderBudget = $companyBusinessUnitTransfer->getFkOrderBudget();

        $this->getFactory()->getCompanyBusinessUnitQuery()
            ->filterByIdCompanyBusinessUnit($idCompanyBusinessUnit)
            ->update(
                [
                    SpyCompanyBusinessUnitEntityTransfer::FK_ORDER_BUDGET => $fkOrderBudget,
                ]
            );
    }
}
