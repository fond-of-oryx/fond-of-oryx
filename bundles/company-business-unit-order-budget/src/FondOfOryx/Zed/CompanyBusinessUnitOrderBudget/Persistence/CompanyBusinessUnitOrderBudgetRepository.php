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
        /** @var \Propel\Runtime\Collection\ArrayCollection $spyCompanyBusinessUnitCollection */
        $spyCompanyBusinessUnitCollection = $this->getFactory()
            ->getCompanyBusinessUnitQuery()
            ->clear()
            ->filterByFkOrderBudget(null, Criteria::ISNULL)
            ->select([SpyCompanyBusinessUnitTableMap::COL_ID_COMPANY_BUSINESS_UNIT])
            ->find();

        return $spyCompanyBusinessUnitCollection->toArray();
    }

    /**
     * @param int $idCompanyBusinessUnit
     *
     * @return int|null
     */
    public function getIdOrderBudgetByIdCompanyBusinessUnit(int $idCompanyBusinessUnit): ?int
    {
        /** @var \Propel\Runtime\ActiveQuery\ModelCriteria $companyBusinessUnitQueryCriteria */
        $companyBusinessUnitQueryCriteria = $this->getFactory()
            ->getCompanyBusinessUnitQuery()
            ->clear()
            ->filterByIdCompanyBusinessUnit($idCompanyBusinessUnit)
            ->select([SpyCompanyBusinessUnitTableMap::COL_FK_ORDER_BUDGET]);

        return $companyBusinessUnitQueryCriteria->findOne();
    }
}
