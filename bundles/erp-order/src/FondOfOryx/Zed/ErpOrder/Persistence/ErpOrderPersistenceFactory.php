<?php

namespace FondOfOryx\Zed\ErpOrder\Persistence;

use FondOfOryx\Zed\ErpOrder\Dependency\Facade\ErpOrderToCompanyBusinessUnitFacadeInterface;
use FondOfOryx\Zed\ErpOrder\Dependency\Facade\ErpOrderToCountryFacadeInterface;
use FondOfOryx\Zed\ErpOrder\ErpOrderDependencyProvider;
use FondOfOryx\Zed\ErpOrder\Persistence\Propel\Mapper\EntityToTransferMapper;
use FondOfOryx\Zed\ErpOrder\Persistence\Propel\Mapper\EntityToTransferMapperInterface;
use Orm\Zed\ErpOrder\Persistence\ErpOrderAddressQuery;
use Orm\Zed\ErpOrder\Persistence\ErpOrderItemQuery;
use Orm\Zed\ErpOrder\Persistence\ErpOrderQuery;
use Orm\Zed\ErpOrder\Persistence\ErpOrderTotalsQuery;
use Orm\Zed\ErpOrder\Persistence\FooErpOrderAmountQuery;
use Orm\Zed\ErpOrder\Persistence\FooErpOrderExpenseQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderRepositoryInterface getRepository()
 */
class ErpOrderPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \FondOfOryx\Zed\ErpOrder\Persistence\Propel\Mapper\EntityToTransferMapperInterface
     */
    public function createEntityToTransferMapper(): EntityToTransferMapperInterface
    {
        return new EntityToTransferMapper(
            $this->getCompanyBusinessUnitFacade(),
            $this->getCountryFacade(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ErpOrder\Dependency\Facade\ErpOrderToCompanyBusinessUnitFacadeInterface
     */
    public function getCompanyBusinessUnitFacade(): ErpOrderToCompanyBusinessUnitFacadeInterface
    {
        return $this->getProvidedDependency(ErpOrderDependencyProvider::FACADE_COMPANY_BUSINESS_UNIT);
    }

    /**
     * @return \FondOfOryx\Zed\ErpOrder\Dependency\Facade\ErpOrderToCountryFacadeInterface
     */
    public function getCountryFacade(): ErpOrderToCountryFacadeInterface
    {
        return $this->getProvidedDependency(ErpOrderDependencyProvider::FACADE_COUNTRY);
    }

    /**
     * @return \Orm\Zed\ErpOrder\Persistence\ErpOrderQuery
     */
    public function createErpOrderQuery(): ErpOrderQuery
    {
        return ErpOrderQuery::create()->clear();
    }

    /**
     * @return \Orm\Zed\ErpOrder\Persistence\ErpOrderItemQuery
     */
    public function createErpOrderItemQuery(): ErpOrderItemQuery
    {
        return ErpOrderItemQuery::create()->clear();
    }

    /**
     * @return \Orm\Zed\ErpOrder\Persistence\ErpOrderAddressQuery
     */
    public function createErpOrderAddressQuery(): ErpOrderAddressQuery
    {
        return ErpOrderAddressQuery::create()->clear();
    }

    /**
     * @return \Orm\Zed\ErpOrder\Persistence\ErpOrderTotalsQuery
     */
    public function createErpOrderTotalsQuery(): ErpOrderTotalsQuery
    {
        return ErpOrderTotalsQuery::create()->clear();
    }

    /**
     * @return \Orm\Zed\ErpOrder\Persistence\FooErpOrderExpenseQuery
     */
    public function createErpOrderExpenseQuery(): FooErpOrderExpenseQuery
    {
        return FooErpOrderExpenseQuery::create()->clear();
    }

    /**
     * @return \Orm\Zed\ErpOrder\Persistence\FooErpOrderAmountQuery
     */
    public function createErpOrderAmountQuery(): FooErpOrderAmountQuery
    {
        return FooErpOrderAmountQuery::create()->clear();
    }
}
