<?php

namespace FondOfOryx\Zed\ErpInvoice\Persistence;

use FondOfOryx\Zed\ErpInvoice\Dependency\Facade\ErpInvoiceToCompanyBusinessUnitFacadeInterface;
use FondOfOryx\Zed\ErpInvoice\Dependency\Facade\ErpInvoiceToCountryFacadeInterface;
use FondOfOryx\Zed\ErpInvoice\ErpInvoiceDependencyProvider;
use FondOfOryx\Zed\ErpInvoice\Persistence\Propel\Mapper\EntityToTransferMapper;
use FondOfOryx\Zed\ErpInvoice\Persistence\Propel\Mapper\EntityToTransferMapperInterface;
use Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceAddressQuery;
use Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceAmountQuery;
use Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceItemQuery;
use Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfOryx\Zed\ErpInvoice\ErpInvoiceConfig getConfig()
 * @method \FondOfOryx\Zed\ErpInvoice\Persistence\ErpInvoiceEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\ErpInvoice\Persistence\ErpInvoiceRepositoryInterface getRepository()
 */
class ErpInvoicePersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \FondOfOryx\Zed\ErpInvoice\Persistence\Propel\Mapper\EntityToTransferMapperInterface
     */
    public function createEntityToTransferMapper(): EntityToTransferMapperInterface
    {
        return new EntityToTransferMapper(
            $this->getCompanyBusinessUnitFacade(),
            $this->getCountryFacade(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ErpInvoice\Dependency\Facade\ErpInvoiceToCompanyBusinessUnitFacadeInterface
     */
    public function getCompanyBusinessUnitFacade(): ErpInvoiceToCompanyBusinessUnitFacadeInterface
    {
        return $this->getProvidedDependency(ErpInvoiceDependencyProvider::FACADE_COMPANY_BUSINESS_UNIT);
    }

    /**
     * @return \FondOfOryx\Zed\ErpInvoice\Dependency\Facade\ErpInvoiceToCountryFacadeInterface
     */
    public function getCountryFacade(): ErpInvoiceToCountryFacadeInterface
    {
        return $this->getProvidedDependency(ErpInvoiceDependencyProvider::FACADE_COUNTRY);
    }

    /**
     * @return \Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceQuery
     */
    public function createErpInvoiceQuery(): FooErpInvoiceQuery
    {
        return FooErpInvoiceQuery::create();
    }

    /**
     * @return \Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceItemQuery
     */
    public function createErpInvoiceItemQuery(): FooErpInvoiceItemQuery
    {
        return FooErpInvoiceItemQuery::create();
    }

    /**
     * @return \Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceAddressQuery
     */
    public function createErpInvoiceAddressQuery(): FooErpInvoiceAddressQuery
    {
        return FooErpInvoiceAddressQuery::create();
    }

    /**
     * @return \Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceAmountQuery
     */
    public function createErpInvoiceAmountQuery(): FooErpInvoiceAmountQuery
    {
        return FooErpInvoiceAmountQuery::create();
    }
}
