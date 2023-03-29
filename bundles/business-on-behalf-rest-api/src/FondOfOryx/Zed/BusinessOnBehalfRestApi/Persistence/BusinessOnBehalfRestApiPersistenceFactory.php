<?php

namespace FondOfOryx\Zed\BusinessOnBehalfRestApi\Persistence;

use FondOfOryx\Zed\BusinessOnBehalfRestApi\BusinessOnBehalfRestApiDependencyProvider;
use Orm\Zed\CompanyUser\Persistence\Base\SpyCompanyUserQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @codeCoverageIgnore
 */
class BusinessOnBehalfRestApiPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\CompanyUser\Persistence\Base\SpyCompanyUserQuery
     */
    public function getCompanyUserQuery(): SpyCompanyUserQuery
    {
        return $this->getProvidedDependency(BusinessOnBehalfRestApiDependencyProvider::PROPEL_QUERY_COMPANY_USER);
    }
}
