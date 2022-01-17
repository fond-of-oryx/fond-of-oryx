<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Persistence;

use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\CompanyBusinessUnitOrderBudgetDependencyProvider;
use Orm\Zed\CompanyBusinessUnit\Persistence\Base\SpyCompanyBusinessUnitQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Persistence\CompanyBusinessUnitOrderBudgetEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Persistence\CompanyBusinessUnitOrderBudgetRepositoryInterface getRepository()
 */
class CompanyBusinessUnitOrderBudgetPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\CompanyBusinessUnit\Persistence\Base\SpyCompanyBusinessUnitQuery
     */
    public function getCompanyBusinessUnitQuery(): SpyCompanyBusinessUnitQuery
    {
        return $this->getProvidedDependency(
            CompanyBusinessUnitOrderBudgetDependencyProvider::QUERY_COMPANY_BUSINESS_UNIT,
        );
    }
}
