<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Persistence;

use FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Persistence\Propel\Mapper\EntityToTransferMapper;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Persistence\Propel\Mapper\EntityToTransferMapperInterface;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Persistence\Propel\Mapper\TransferToEntityMapper;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Persistence\Propel\Mapper\TransferToEntityMapperInterface;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\RepresentativeCompanyUserTradeFairDependencyProvider;
use Orm\Zed\Company\Persistence\SpyCompanyQuery;
use Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleQuery;
use Orm\Zed\Customer\Persistence\SpyCustomerQuery;
use Orm\Zed\RepresentativeCompanyUser\Persistence\FooRepresentativeCompanyUserQuery;
use Orm\Zed\RepresentativeCompanyUserTradeFair\Persistence\FooRepresentativeCompanyUserTradeFairQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @codeCoverageIgnore
 * @method \FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\RepresentativeCompanyUserTradeFairConfig getConfig()
 */
class RepresentativeCompanyUserTradeFairPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\RepresentativeCompanyUserTradeFair\Persistence\FooRepresentativeCompanyUserTradeFairQuery
     */
    public function getRepresentativeCompanyUserTradeFairQuery(): FooRepresentativeCompanyUserTradeFairQuery
    {
        return new FooRepresentativeCompanyUserTradeFairQuery();
    }

    /**
     * @return \FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Persistence\Propel\Mapper\TransferToEntityMapperInterface
     */
    public function createTransferToEntityMapper(): TransferToEntityMapperInterface
    {
        return new TransferToEntityMapper();
    }

    /**
     * @return \FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Persistence\Propel\Mapper\EntityToTransferMapperInterface
     */
    public function createEntityToTransferMapper(): EntityToTransferMapperInterface
    {
        return new EntityToTransferMapper();
    }

    /**
     * @return \Orm\Zed\RepresentativeCompanyUser\Persistence\FooRepresentativeCompanyUserQuery
     */
    public function getRepresentativeCompanyUserQuery(): FooRepresentativeCompanyUserQuery
    {
        return $this->getProvidedDependency(RepresentativeCompanyUserTradeFairDependencyProvider::QUERY_REPRESENTATIVE_COMPANY_USER);
    }

    /**
     * @return \Orm\Zed\Customer\Persistence\SpyCustomerQuery
     */
    public function getCustomerQuery(): SpyCustomerQuery
    {
        return $this->getProvidedDependency(RepresentativeCompanyUserTradeFairDependencyProvider::QUERY_CUSTOMER);
    }

    /**
     * @return \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleQuery
     */
    public function getCompanyRoleQuery(): SpyCompanyRoleQuery
    {
        return $this->getProvidedDependency(RepresentativeCompanyUserTradeFairDependencyProvider::QUERY_COMPANY_ROLE);
    }

    /**
     * @return \Orm\Zed\Company\Persistence\SpyCompanyQuery
     */
    public function getCompanyQuery(): SpyCompanyQuery
    {
        return $this->getProvidedDependency(RepresentativeCompanyUserTradeFairDependencyProvider::QUERY_COMPANY);
    }

    /**
     * @return array<\FondOfOryx\Zed\RepresentativeCompanyUserTradeFairExtension\Dependency\Plugin\Persistence\RepresentativeCompanyUserTradeFairQueryExpanderPluginInterface>
     */
    public function getFooRepresentativeCompanyUserTradeFairQueryExpanderPlugins(): array
    {
        return $this->getProvidedDependency(RepresentativeCompanyUserTradeFAirDependencyProvider::PLUGINS_FOO_REPRESENTATIVE_COMPANY_USER_TRADE_FAIR_EXPANDER);
    }
}
