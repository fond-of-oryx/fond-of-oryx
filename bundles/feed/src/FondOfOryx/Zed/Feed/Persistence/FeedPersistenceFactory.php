<?php

namespace FondOfOryx\Zed\Feed\Persistence;

use FondOfOryx\Zed\Feed\Dependency\Facade\FeedToStoreFacadeInterface;
use FondOfOryx\Zed\Feed\FeedDependencyProvider;
use Orm\Zed\Availability\Persistence\SpyAvailabilityQuery;
use Orm\Zed\AvailabilityAlert\Persistence\FooAvailabilityAlertSubscriptionQuery;
use Orm\Zed\Store\Persistence\Base\SpyStoreQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfOryx\Zed\Feed\FeedConfig getConfig()
 * @method \FondOfOryx\Zed\Feed\Persistence\FeedRepository getRepository()
 */
class FeedPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\Store\Persistence\SpyStoreQuery
     */
    public function createStoreQuery(): SpyStoreQuery
    {
        return SpyStoreQuery::create();
    }

    /**
     * @return \FondOfOryx\Zed\Feed\Dependency\Facade\FeedToStoreFacadeInterface
     */
    public function getStoreFacade(): FeedToStoreFacadeInterface
    {
        return $this->getProvidedDependency(FeedDependencyProvider::FACADE_STORE);
    }

    /**
     * @return \Orm\Zed\AvailabilityAlert\Persistence\FooAvailabilityAlertSubscriptionQuery
     */
    public function getAvailabilityAlertSubscriptionQuery(): FooAvailabilityAlertSubscriptionQuery
    {
        return $this->getProvidedDependency(FeedDependencyProvider::PROPEL_AVAILABILITY_ALERT_SUBSCRIPTION_QUERY);
    }

    /**
     * @return \Orm\Zed\Availability\Persistence\SpyAvailabilityQuery
     */
    public function getAvailabilityQuery(): SpyAvailabilityQuery
    {
        return $this->getProvidedDependency(FeedDependencyProvider::PROPEL_AVAILABILITY_QUERY);
    }
}
