<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Persistence;

use FondOfOryx\Zed\ErpDeliveryNote\Dependency\Facade\ErpDeliveryNoteToCompanyBusinessUnitFacadeInterface;
use FondOfOryx\Zed\ErpDeliveryNote\ErpDeliveryNoteDependencyProvider;
use FondOfOryx\Zed\ErpDeliveryNote\Persistence\Propel\Mapper\EntityToTransferMapper;
use FondOfOryx\Zed\ErpDeliveryNote\Persistence\Propel\Mapper\EntityToTransferMapperInterface;
use Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteAddressQuery;
use Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteExpenseQuery;
use Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteItemQuery;
use Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteQuery;
use Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteTrackingQuery;
use Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteTrackingToItemQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfOryx\Zed\ErpDeliveryNote\ErpDeliveryNoteConfig getConfig()
 * @method \FondOfOryx\Zed\ErpDeliveryNote\Persistence\ErpDeliveryNoteEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\ErpDeliveryNote\Persistence\ErpDeliveryNoteRepositoryInterface getRepository()
 */
class ErpDeliveryNotePersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \FondOfOryx\Zed\ErpDeliveryNote\Persistence\Propel\Mapper\EntityToTransferMapperInterface
     */
    public function createEntityToTransferMapper(): EntityToTransferMapperInterface
    {
        return new EntityToTransferMapper(
            $this->getCompanyBusinessUnitFacade(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ErpDeliveryNote\Dependency\Facade\ErpDeliveryNoteToCompanyBusinessUnitFacadeInterface
     */
    public function getCompanyBusinessUnitFacade(): ErpDeliveryNoteToCompanyBusinessUnitFacadeInterface
    {
        return $this->getProvidedDependency(ErpDeliveryNoteDependencyProvider::FACADE_COMPANY_BUSINESS_UNIT);
    }

    /**
     * @return \Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteQuery
     */
    public function createErpDeliveryNoteQuery(): FooErpDeliveryNoteQuery
    {
        return FooErpDeliveryNoteQuery::create();
    }

    /**
     * @return \Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteItemQuery
     */
    public function createErpDeliveryNoteItemQuery(): FooErpDeliveryNoteItemQuery
    {
        return FooErpDeliveryNoteItemQuery::create();
    }

    /**
     * @return \Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteExpenseQuery
     */
    public function createErpDeliveryNoteExpenseQuery(): FooErpDeliveryNoteExpenseQuery
    {
        return FooErpDeliveryNoteExpenseQuery::create();
    }

    /**
     * @return \Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteAddressQuery
     */
    public function createErpDeliveryNoteAddressQuery(): FooErpDeliveryNoteAddressQuery
    {
        return FooErpDeliveryNoteAddressQuery::create();
    }

    /**
     * @return \Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteTrackingQuery
     */
    public function createErpDeliveryNoteTrackingQuery(): FooErpDeliveryNoteTrackingQuery
    {
        return FooErpDeliveryNoteTrackingQuery::create();
    }

    /**
     * @return \Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteTrackingToItemQuery
     */
    public function createErpDeliveryNoteTrackingToItemQuery(): FooErpDeliveryNoteTrackingToItemQuery
    {
        return FooErpDeliveryNoteTrackingToItemQuery::create();
    }
}
