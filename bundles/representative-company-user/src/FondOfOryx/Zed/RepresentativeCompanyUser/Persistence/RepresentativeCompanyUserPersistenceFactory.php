<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUser\Persistence;

use FondOfOryx\Zed\RepresentativeCompanyUser\Persistence\Propel\Mapper\EntityToTransferMapper;
use FondOfOryx\Zed\RepresentativeCompanyUser\Persistence\Propel\Mapper\EntityToTransferMapperInterface;
use FondOfOryx\Zed\RepresentativeCompanyUser\Persistence\Propel\Mapper\TransferToEntityMapper;
use FondOfOryx\Zed\RepresentativeCompanyUser\Persistence\Propel\Mapper\TransferToEntityMapperInterface;
use FondOfOryx\Zed\RepresentativeCompanyUser\RepresentativeCompanyUserDependencyProvider;
use Orm\Zed\Company\Persistence\SpyCompanyQuery;
use Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery;
use Orm\Zed\RepresentativeCompanyUser\Persistence\FooRepresentativeCompanyUserQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @codeCoverageIgnore
 */
class RepresentativeCompanyUserPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\RepresentativeCompanyUser\Persistence\FooRepresentativeCompanyUserQuery
     */
    public function getRepresentativeCompanyUserQuery(): FooRepresentativeCompanyUserQuery
    {
        return new FooRepresentativeCompanyUserQuery();
    }

    /**
     * @return \FondOfOryx\Zed\RepresentativeCompanyUser\Persistence\Propel\Mapper\TransferToEntityMapperInterface
     */
    public function createTransferToEntityMapper(): TransferToEntityMapperInterface
    {
        return new TransferToEntityMapper();
    }

    /**
     * @return \FondOfOryx\Zed\RepresentativeCompanyUser\Persistence\Propel\Mapper\EntityToTransferMapperInterface
     */
    public function createEntityToTransferMapper(): EntityToTransferMapperInterface
    {
        return new EntityToTransferMapper();
    }

    /**
     * @return \Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery
     */
    public function getCompanyUserQuery(): SpyCompanyUserQuery
    {
        return $this->getProvidedDependency(RepresentativeCompanyUserDependencyProvider::QUERY_COMPANY_USER);
    }

    /**
     * @return \Orm\Zed\Company\Persistence\SpyCompanyQuery
     */
    public function getCompanyQuery(): SpyCompanyQuery
    {
        return $this->getProvidedDependency(RepresentativeCompanyUserDependencyProvider::QUERY_COMPANY);
    }
}
