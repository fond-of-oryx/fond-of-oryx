<?php

namespace FondOfOryx\Zed\ErpDeliveryNotePageSearch\Persistence;

use FondOfOryx\Zed\ErpDeliveryNotePageSearch\ErpDeliveryNotePageSearchDependencyProvider;
use FondOfOryx\Zed\ErpDeliveryNotePageSearch\Persistence\Propel\Mapper\ErpDeliveryNotePageSearchMapper;
use FondOfOryx\Zed\ErpDeliveryNotePageSearch\Persistence\Propel\Mapper\ErpDeliveryNotePageSearchMapperInterface;
use Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteQuery;
use Orm\Zed\ErpDeliveryNotePageSearch\Persistence\FooErpDeliveryNotePageSearchQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfOryx\Zed\ErpDeliveryNotePageSearch\ErpDeliveryNotePageSearchConfig getConfig()
 * @method \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Persistence\ErpDeliveryNotePageSearchQueryContainerInterface getQueryContainer()
 * @method \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Persistence\ErpDeliveryNotePageSearchEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Persistence\ErpDeliveryNotePageSearchRepositoryInterface getRepository()
 */
class ErpDeliveryNotePageSearchPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Persistence\Propel\Mapper\ErpDeliveryNotePageSearchMapperInterface
     */
    public function createErpDeliveryNotePageSearchMapper(): ErpDeliveryNotePageSearchMapperInterface
    {
        return new ErpDeliveryNotePageSearchMapper();
    }

    /**
     * @return \Orm\Zed\ErpDeliveryNotePageSearch\Persistence\FooErpDeliveryNotePageSearchQuery
     */
    public function getErpDeliveryNotePageSearchQuery(): FooErpDeliveryNotePageSearchQuery
    {
        return $this->getProvidedDependency(ErpDeliveryNotePageSearchDependencyProvider::QUERY_ERP_DELIVERY_NOTE_PAGE_SEARCH);
    }

    /**
     * @return \Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteQuery
     */
    public function getErpDeliveryNoteQuery(): FooErpDeliveryNoteQuery
    {
        return $this->getProvidedDependency(ErpDeliveryNotePageSearchDependencyProvider::QUERY_ERP_DELIVERY_NOTE);
    }
}
