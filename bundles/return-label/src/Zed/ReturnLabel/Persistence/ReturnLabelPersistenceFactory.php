<?php

namespace FondOfOryx\Zed\ReturnLabel\Persistence;

use FondOfOryx\Zed\ReturnLabel\Dependency\QueryContainer\ReturnLabelToCompanyUnitAddressQueryContainerInterface;
use Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddress;
use Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery;
use Orm\Zed\Customer\Persistence\SpyCustomerQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;
use FondOfOryx\Zed\ReturnLabel\ReturnLabelDependencyProvider;
use Spryker\Zed\CompanyUnitAddress\Persistence\CompanyUnitAddressRepository;
use FondOfOryx\Zed\ReturnLabel\Persistence\Propel\Mapper\ReturnLabelCompanyUnitAddressMapper;
use FondOfOryx\Zed\ReturnLabel\Persistence\Propel\Mapper\ReturnLabelCompanyUnitAddressMapperInterface;

class ReturnLabelPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return ReturnLabelCompanyUnitAddressMapperInterface
     */
    public function createReturnLabelCompanyUnitAddressMapper(): ReturnLabelCompanyUnitAddressMapperInterface
    {
        return new ReturnLabelCompanyUnitAddressMapper();
    }

    /**
     * @return SpyCustomerQuery
     */
    public function createSpyCustomerQuery(): SpyCustomerQuery
    {
        return SpyCustomerQuery::create();
    }

    /**
     * @return SpyCompanyUnitAddressQuery
     */
    public function createCompanyUnitAddressQuery(): SpyCompanyUnitAddressQuery
    {
        return SpyCompanyUnitAddressQuery::create();
    }

    /**
     * @return ReturnLabelToCompanyUnitAddressQueryContainerInterface
     *
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function getCompanyUnitAddressQueryContainer(): ReturnLabelToCompanyUnitAddressQueryContainerInterface
    {
        return $this->getProvidedDependency(ReturnLabelDependencyProvider::COMPANY_UNIT_ADDRESS_QUERY_CONTAINER);
    }
}
