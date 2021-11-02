<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Persistence;

use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\SpyCompanyBusinessUnitEntityTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Persistence\CompanyBusinessUnitOrderBudgetPersistenceFactory getFactory()
 */
class CompanyBusinessUnitOrderBudgetEntityManager extends AbstractEntityManager implements
    CompanyBusinessUnitOrderBudgetEntityManagerInterface
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
                    ucfirst(SpyCompanyBusinessUnitEntityTransfer::FK_ORDER_BUDGET) => $fkOrderBudget,
                ],
            );
    }
}
