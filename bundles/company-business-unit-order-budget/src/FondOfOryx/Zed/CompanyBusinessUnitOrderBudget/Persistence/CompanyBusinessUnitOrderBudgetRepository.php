<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Persistence;

use Orm\Zed\CompanyBusinessUnit\Persistence\Map\SpyCompanyBusinessUnitTableMap;
use Propel\Runtime\ActiveQuery\Criteria;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Persistence\CompanyBusinessUnitOrderBudgetPersistenceFactory getFactory()
 */
class CompanyBusinessUnitOrderBudgetRepository extends AbstractRepository implements CompanyBusinessUnitOrderBudgetRepositoryInterface
{
    /**
     * @return array<int>
     */
    public function getCompanyBusinessUnitIdsWithoutOrderBudget(): array
    {
        return $this->getFactory()->getCompanyBusinessUnitQuery()
            ->clear()
            ->filterByFkOrderBudget(null, Criteria::ISNULL)
            ->select([SpyCompanyBusinessUnitTableMap::COL_ID_COMPANY_BUSINESS_UNIT])
            ->find()
            ->toArray();
    }

    /**
     * @param int $idCompanyBusinessUnit
     *
     * @return int|null
     */
    public function getIdOrderBudgetByIdCompanyBusinessUnit(int $idCompanyBusinessUnit): ?int
    {
        return $this->getFactory()->getCompanyBusinessUnitQuery()
            ->clear()
            ->filterByIdCompanyBusinessUnit($idCompanyBusinessUnit)
            ->select([SpyCompanyBusinessUnitTableMap::COL_FK_ORDER_BUDGET])
            ->findOne();
    }
}
