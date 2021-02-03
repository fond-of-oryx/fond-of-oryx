<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch\Communication;

use FondOfOryx\Zed\ErpOrderPageSearch\Dependency\Facade\ErpOrderPageSearchToEventBehaviorFacadeInterface;
use FondOfOryx\Zed\ErpOrderPageSearch\ErpOrderPageSearchDependencyProvider;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;

/**
 * @method \FondOfOryx\Zed\ErpOrderPageSearch\Persistence\ErpOrderPageSearchQueryContainerInterface getQueryContainer()
 * @method \FondOfOryx\Zed\ErpOrderPageSearch\ErpOrderPageSearchConfig getConfig()
 * @method \FondOfOryx\Zed\ErpOrderPageSearch\Business\ErpOrderPageSearchFacadeInterface getFacade()
 */
class ErpOrderPageSearchCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return \FondOfOryx\Zed\ErpOrderPageSearch\Dependency\Facade\ErpOrderPageSearchToEventBehaviorFacadeInterface
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function getEventBehaviorFacade(): ErpOrderPageSearchToEventBehaviorFacadeInterface
    {
        return $this->getProvidedDependency(ErpOrderPageSearchDependencyProvider::FACADE_EVENT_BEHAVIOR);
    }
}
