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
            ->filterByFkOrderBudget(null, Criteria::ISNULL)
            ->select([SpyCompanyBusinessUnitTableMap::COL_ID_COMPANY_BUSINESS_UNIT])
            ->find()
            ->toArray();
    }
}
