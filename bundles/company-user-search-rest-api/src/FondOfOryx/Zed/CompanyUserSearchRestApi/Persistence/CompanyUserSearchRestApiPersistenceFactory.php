<?php

namespace FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence;

use FondOfOryx\Zed\CompanyUserSearchRestApi\CompanyUserSearchRestApiDependencyProvider;
use FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence\Propel\Mapper\CompanyRoleMapper;
use FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence\Propel\Mapper\CompanyRoleMapperInterface;
use FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence\Propel\Mapper\CompanyUserMapper;
use FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence\Propel\Mapper\CompanyUserMapperInterface;
use FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence\Propel\Mapper\CustomerMapper;
use FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence\Propel\Mapper\CustomerMapperInterface;
use Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence\CompanyUserSearchRestApiRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\CompanyUserSearchRestApi\CompanyUserSearchRestApiConfig getConfig()
 */
class CompanyUserSearchRestApiPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery
     */
    public function getCompanyUserQuery(): SpyCompanyUserQuery
    {
        return $this->getProvidedDependency(CompanyUserSearchRestApiDependencyProvider::PROPEL_QUERY_COMPANY_USER);
    }

    /**
     * @return \FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence\Propel\Mapper\CompanyUserMapperInterface
     */
    public function createCompanyUserMapper(): CompanyUserMapperInterface
    {
        return new CompanyUserMapper(
            $this->createCustomerMapper(),
            $this->createCompanyRoleMapper(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence\Propel\Mapper\CompanyRoleMapperInterface
     */
    public function createCompanyRoleMapper(): CompanyRoleMapperInterface
    {
        return new CompanyRoleMapper();
    }

    /**
     * @return \FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence\Propel\Mapper\CustomerMapperInterface
     */
    public function createCustomerMapper(): CustomerMapperInterface
    {
        return new CustomerMapper();
    }
}
