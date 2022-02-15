<?php

namespace FondOfOryx\Zed\ErpDeliveryNoteApi\Persistence;

use FondOfOryx\Zed\ErpDeliveryNoteApi\Dependency\QueryContainer\ErpDeliveryNoteApiToApiQueryBuilderQueryContainerInterface;
use FondOfOryx\Zed\ErpDeliveryNoteApi\Dependency\QueryContainer\ErpDeliveryNoteApiToApiQueryContainerInterface;
use FondOfOryx\Zed\ErpDeliveryNoteApi\ErpDeliveryNoteApiDependencyProvider;
use Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfOryx\Zed\ErpDeliveryNoteApi\Persistence\ErpDeliveryNoteApiRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\ErpDeliveryNoteApi\ErpDeliveryNoteApiConfig getConfig()
 */
class ErpDeliveryNoteApiPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteQuery
     */
    public function getErpDeliveryNoteQuery(): FooErpDeliveryNoteQuery
    {
        return $this->getProvidedDependency(ErpDeliveryNoteApiDependencyProvider::PROPEL_QUERY_ERP_DELIVERY_NOTE);
    }

    /**
     * @return \FondOfOryx\Zed\ErpDeliveryNoteApi\Dependency\QueryContainer\ErpDeliveryNoteApiToApiQueryBuilderQueryContainerInterface
     */
    public function getApiQueryBuilderQueryContainer(): ErpDeliveryNoteApiToApiQueryBuilderQueryContainerInterface
    {
        return $this->getProvidedDependency(ErpDeliveryNoteApiDependencyProvider::QUERY_CONTAINER_API_QUERY_BUILDER);
    }

    /**
     * @return \FondOfOryx\Zed\ErpDeliveryNoteApi\Dependency\QueryContainer\ErpDeliveryNoteApiToApiQueryContainerInterface
     */
    public function getApiQueryContainer(): ErpDeliveryNoteApiToApiQueryContainerInterface
    {
        return $this->getProvidedDependency(ErpDeliveryNoteApiDependencyProvider::QUERY_CONTAINER_API);
    }
}
