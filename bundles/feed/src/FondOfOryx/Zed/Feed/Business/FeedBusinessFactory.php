<?php

namespace FondOfOryx\Zed\Feed\Business;

use FondOfOryx\Zed\Feed\Business\Availability\AvailabilityAlertFeed;
use FondOfOryx\Zed\Feed\Business\Availability\AvailabilityFeed;
use FondOfOryx\Zed\Feed\Dependency\Facade\FeedToProductFacadeInterface;
use FondOfOryx\Zed\Feed\Dependency\Facade\FeedToStoreFacadeInterface;
use FondOfOryx\Zed\Feed\FeedDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\Feed\FeedConfig getConfig()
 * @method \FondOfOryx\Zed\Feed\Persistence\FeedRepositoryInterface getRepository()
 */
class FeedBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\Feed\Business\Availability\AvailabilityFeed
     */
    public function createAvailabilityFeed(): AvailabilityFeed
    {
        return new AvailabilityFeed($this->getRepository(), $this->getStoreFacade());
    }

    /**
     * @return \FondOfOryx\Zed\Feed\Business\Availability\AvailabilityAlertFeed
     */
    public function createAvailabilityAlertFeed(): AvailabilityAlertFeed
    {
        return new AvailabilityAlertFeed($this->getRepository(), $this->getProductFacade(), $this->getStoreFacade());
    }

    /**
     * @return \FondOfOryx\Zed\Feed\Dependency\Facade\FeedToProductFacadeInterface
     */
    protected function getProductFacade(): FeedToProductFacadeInterface
    {
        return $this->getProvidedDependency(FeedDependencyProvider::PRODUCT_FACADE);
    }

    /**
     * @return \FondOfOryx\Zed\Feed\Dependency\Facade\FeedToStoreFacadeInterface
     */
    protected function getStoreFacade(): FeedToStoreFacadeInterface
    {
        return $this->getProvidedDependency(FeedDependencyProvider::FACADE_STORE);
    }
}
