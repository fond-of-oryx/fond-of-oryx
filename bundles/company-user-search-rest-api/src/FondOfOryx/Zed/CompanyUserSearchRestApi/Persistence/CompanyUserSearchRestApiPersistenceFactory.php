<?php

namespace FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence;

use FondOfOryx\Zed\CompanyUserSearchRestApi\CompanyUserSearchRestApiDependencyProvider;
use FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence\Propel\Expander\CompanyUserTransferPostMapExpander;
use FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence\Propel\Expander\CompanyUserTransferPostMapExpanderInterface;
use FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence\Propel\Mapper\CompanyRoleMapper;
use FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence\Propel\Mapper\CompanyRoleMapperInterface;
use FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence\Propel\Mapper\CompanyUserMapper;
use FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence\Propel\Mapper\CompanyUserMapperInterface;
use FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence\Propel\Mapper\CustomerMapper;
use FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence\Propel\Mapper\CustomerMapperInterface;
use FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence\Propel\QueryBuilder\CompanyUserQueryJoinQueryBuilder;
use FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence\Propel\QueryBuilder\CompanyUserQueryJoinQueryBuilderInterface;
use FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence\Propel\QueryBuilder\CompanyUserSearchFilterFieldQueryBuilder;
use FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence\Propel\QueryBuilder\CompanyUserSearchFilterFieldQueryBuilderInterface;
use Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @codeCoverageIgnore
 *
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
     * @return array<\FondOfOryx\Zed\CompanyUserSearchRestApiExtension\Dependency\Plugin\CompanyUserTransferPostMapExpanderPluginInterface>
     */
    public function getCompanyUserTransferPostMapExpanderPlugins(): array
    {
        return $this->getProvidedDependency(CompanyUserSearchRestApiDependencyProvider::PLUGINS_COMPANY_USER_TRANSFER_POST_MAP_EXPANDER);
    }

    /**
     * @return \FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence\Propel\Mapper\CompanyUserMapperInterface
     */
    public function createCompanyUserMapper(): CompanyUserMapperInterface
    {
        return new CompanyUserMapper(
            $this->createCustomerMapper(),
            $this->createCompanyRoleMapper(),
            $this->createCompanyUserTransferPostMapExpander(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence\Propel\Expander\CompanyUserTransferPostMapExpanderInterface
     */
    public function createCompanyUserTransferPostMapExpander(): CompanyUserTransferPostMapExpanderInterface
    {
        return new CompanyUserTransferPostMapExpander(
            $this->getCompanyUserTransferPostMapExpanderPlugins(),
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

    /**
     * @return \FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence\Propel\QueryBuilder\CompanyUserQueryJoinQueryBuilderInterface
     */
    public function createCompanyUserQueryJoinQueryBuilder(): CompanyUserQueryJoinQueryBuilderInterface
    {
        return new CompanyUserQueryJoinQueryBuilder();
    }

    /**
     * @return \FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence\Propel\QueryBuilder\CompanyUserSearchFilterFieldQueryBuilderInterface
     */
    public function createCompanyUserSearchFilterFieldQueryBuilder(): CompanyUserSearchFilterFieldQueryBuilderInterface
    {
        return new CompanyUserSearchFilterFieldQueryBuilder(
            $this->getConfig(),
        );
    }
}
