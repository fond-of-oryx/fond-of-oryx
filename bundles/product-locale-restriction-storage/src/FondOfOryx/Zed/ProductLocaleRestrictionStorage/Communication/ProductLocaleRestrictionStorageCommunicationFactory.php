<?php

namespace FondOfOryx\Zed\ProductLocaleRestrictionStorage\Communication;

use FondOfOryx\Zed\ProductLocaleRestrictionStorage\Dependency\Facade\ProductLocaleRestrictionStorageToEventBehaviorFacadeInterface;
use FondOfOryx\Zed\ProductLocaleRestrictionStorage\ProductLocaleRestrictionStorageDependencyProvider;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;

/**
 * @method \FondOfOryx\Zed\ProductLocaleRestrictionStorage\ProductLocaleRestrictionStorageConfig getConfig()
 * @method \FondOfOryx\Zed\ProductLocaleRestrictionStorage\Persistence\ProductLocaleRestrictionStorageRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\ProductLocaleRestrictionStorage\Business\ProductLocaleRestrictionStorageFacadeInterface getFacade()
 */
class ProductLocaleRestrictionStorageCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return \FondOfOryx\Zed\ProductLocaleRestrictionStorage\Dependency\Facade\ProductLocaleRestrictionStorageToEventBehaviorFacadeInterface
     */
    public function getEventBehaviorFacade(): ProductLocaleRestrictionStorageToEventBehaviorFacadeInterface
    {
        return $this->getProvidedDependency(ProductLocaleRestrictionStorageDependencyProvider::FACADE_EVENT_BEHAVIOR);
    }
}
