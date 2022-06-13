<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Persistence;

use FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\CompanyBusinessUnitCartSearchRestApiDependencyProvider;
use Orm\Zed\CompanyBusinessUnit\Persistence\Base\SpyCompanyBusinessUnitQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @codeCoverageIgnore
 */
class CompanyBusinessUnitCartSearchRestApiPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\CompanyBusinessUnit\Persistence\Base\SpyCompanyBusinessUnitQuery
     */
    public function getCompanyBusinessUnitQuery(): SpyCompanyBusinessUnitQuery
    {
        return $this->getProvidedDependency(
            CompanyBusinessUnitCartSearchRestApiDependencyProvider::PROPEL_QUERY_COMPANY_BUSINESS_UNIT,
        );
    }
}
