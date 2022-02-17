<?php

namespace FondOfOryx\Zed\ErpDeliveryNotePageSearch\Communication;

use FondOfOryx\Zed\ErpDeliveryNotePageSearch\Dependency\Facade\ErpDeliveryNotePageSearchToEventBehaviorFacadeInterface;
use FondOfOryx\Zed\ErpDeliveryNotePageSearch\ErpDeliveryNotePageSearchDependencyProvider;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;

/**
 * @method \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Persistence\ErpDeliveryNotePageSearchQueryContainerInterface getQueryContainer()
 * @method \FondOfOryx\Zed\ErpDeliveryNotePageSearch\ErpDeliveryNotePageSearchConfig getConfig()
 * @method \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\ErpDeliveryNotePageSearchFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Persistence\ErpDeliveryNotePageSearchEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Persistence\ErpDeliveryNotePageSearchRepositoryInterface getRepository()
 */
class ErpDeliveryNotePageSearchCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Dependency\Facade\ErpDeliveryNotePageSearchToEventBehaviorFacadeInterface
     */
    public function getEventBehaviorFacade(): ErpDeliveryNotePageSearchToEventBehaviorFacadeInterface
    {
        return $this->getProvidedDependency(ErpDeliveryNotePageSearchDependencyProvider::FACADE_EVENT_BEHAVIOR);
    }
}
