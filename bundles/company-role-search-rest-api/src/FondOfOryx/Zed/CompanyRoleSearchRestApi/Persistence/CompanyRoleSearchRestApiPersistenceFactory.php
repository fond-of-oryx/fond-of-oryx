<?php

namespace FondOfOryx\Zed\CompanyRoleSearchRestApi\Persistence;

use FondOfOryx\Zed\CompanyRoleSearchRestApi\CompanyRoleSearchRestApiDependencyProvider;
use FondOfOryx\Zed\CompanyRoleSearchRestApi\Persistence\Propel\Mapper\CompanyRoleMapper;
use FondOfOryx\Zed\CompanyRoleSearchRestApi\Persistence\Propel\Mapper\CompanyRoleMapperInterface;
use Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfOryx\Zed\CompanyRoleSearchRestApi\Persistence\CompanyRoleSearchRestApiRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\CompanyRoleSearchRestApi\CompanyRoleSearchRestApiConfig getConfig()
 */
class CompanyRoleSearchRestApiPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleQuery
     */
    public function getCompanyRoleQuery(): SpyCompanyRoleQuery
    {
        return $this->getProvidedDependency(CompanyRoleSearchRestApiDependencyProvider::PROPEL_QUERY_COMPANY_ROLE);
    }

    /**
     * @return \FondOfOryx\Zed\CompanyRoleSearchRestApi\Persistence\Propel\Mapper\CompanyRoleMapperInterface
     */
    public function createCompanyRoleMapper(): CompanyRoleMapperInterface
    {
        return new CompanyRoleMapper();
    }
}
