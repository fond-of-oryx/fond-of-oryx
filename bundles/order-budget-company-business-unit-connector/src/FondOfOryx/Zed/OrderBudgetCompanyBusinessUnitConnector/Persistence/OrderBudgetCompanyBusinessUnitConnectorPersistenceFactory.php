<?php

namespace FondOfOryx\Zed\OrderBudgetCompanyBusinessUnitConnector\Persistence;

use FondOfOryx\Zed\OrderBudgetCompanyBusinessUnitConnector\OrderBudgetCompanyBusinessUnitConnectorDependencyProvider;
use Orm\Zed\CompanyBusinessUnit\Persistence\Base\SpyCompanyBusinessUnitQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfOryx\Zed\OrderBudgetCompanyBusinessUnitConnector\Persistence\OrderBudgetCompanyBusinessUnitConnectorEntityManagerInterface getEntityManager()
 */
class OrderBudgetCompanyBusinessUnitConnectorPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\CompanyBusinessUnit\Persistence\Base\SpyCompanyBusinessUnitQuery
     */
    public function getCompanyBusinessUnitQuery(): SpyCompanyBusinessUnitQuery
    {
        return $this->getProvidedDependency(
            OrderBudgetCompanyBusinessUnitConnectorDependencyProvider::QUERY_COMPANY_BUSINESS_UNIT
        );
    }
}
