<?php

namespace FondOfOryx\Zed\Feed;

use FondOfOryx\Zed\Feed\Dependency\Facade\FeedToProductFacadeBridge;
use FondOfOryx\Zed\Feed\Dependency\Facade\FeedToStoreFacadeBridge;
use Orm\Zed\Availability\Persistence\SpyAvailabilityQuery;
use Orm\Zed\AvailabilityAlert\Persistence\FooAvailabilityAlertSubscriptionQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class FeedDependencyProvider extends AbstractBundleDependencyProvider
{
    public const PROPEL_AVAILABILITY_QUERY = 'PROPEL_AVAILABILITY_QUERY';
    public const PROPEL_AVAILABILITY_ALERT_SUBSCRIPTION_QUERY = 'PROPEL_AVAILABILITY_ALERT_SUBSCRIPTION_QUERY';
    public const PRODUCT_FACADE = 'PRODUCT_FACADE';
    public const FACADE_STORE = 'FACADE_STORE';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = $this->provideProductFacade($container);
        $container = $this->addStoreFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container)
    {
        $container = $this->addAvailabilityQuery($container);
        $container = $this->addAvailabilityAlertSubscriptionQuery($container);
        $container = $this->addStoreFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addAvailabilityQuery(Container $container): Container
    {
        $container[static::PROPEL_AVAILABILITY_QUERY] = function () {
            return SpyAvailabilityQuery::create();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addAvailabilityAlertSubscriptionQuery(Container $container): Container
    {
        $container[static::PROPEL_AVAILABILITY_ALERT_SUBSCRIPTION_QUERY] = function () {
            return FooAvailabilityAlertSubscriptionQuery::create();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideProductFacade(Container $container): Container
    {
        $container[static::PRODUCT_FACADE] = function (Container $container) {
            return new FeedToProductFacadeBridge($container->getLocator()->product()->facade());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addStoreFacade(Container $container): Container
    {
        $container[static::FACADE_STORE] = function (Container $container) {
            return new FeedToStoreFacadeBridge($container->getLocator()->store()->facade());
        };

        return $container;
    }
}
