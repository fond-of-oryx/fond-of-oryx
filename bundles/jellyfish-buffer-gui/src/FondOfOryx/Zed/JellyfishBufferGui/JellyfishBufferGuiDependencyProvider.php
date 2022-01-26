<?php

namespace FondOfOryx\Zed\JellyfishBufferGui;

use FondOfOryx\Zed\JellyfishBufferGui\Dependency\Facade\JellyfishBufferGuiToJellyfishBufferBridge;
use FondOfOryx\Zed\JellyfishBufferGui\Dependency\Facade\JellyfishBufferGuiToStoreFacadeBridge;
use Orm\Zed\JellyfishBuffer\Persistence\FooExportedOrderHistoryQuery;
use Orm\Zed\JellyfishBuffer\Persistence\FooExportedOrderQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

/**
 * @method \FondOfOryx\Zed\JellyfishBufferGui\JellyfishBufferGuiConfig getConfig()
 */
class JellyfishBufferGuiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_JELLYFISH_BUFFER = 'FACADE_JELLYFISH_BUFFER';

    /**
     * @var string
     */
    public const FACADE_STORE = 'FACADE_STORE';

    /**
     * @var string
     */
    public const QUERY_EXPORTED_ORDER_HISTORY = 'QUERY_EXPORTED_ORDER_HISTORY';

    /**
     * @var string
     */
    public const QUERY_EXPORTED_ORDER = 'QUERY_EXPORTED_ORDER';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container)
    {
        $container = $this->addJellyfishBufferFacade($container);
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
        $container = $this->addExportedOrderQuery($container);
        $container = $this->addExportedOrderHistoryQuery($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addJellyfishBufferFacade(Container $container)
    {
        $container[static::FACADE_JELLYFISH_BUFFER] = static function (Container $container) {
            return new JellyfishBufferGuiToJellyfishBufferBridge($container->getLocator()->jellyfishBuffer()->facade());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addStoreFacade(Container $container)
    {
        $container[static::FACADE_STORE] = static function (Container $container) {
            return new JellyfishBufferGuiToStoreFacadeBridge($container->getLocator()->store()->facade());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addExportedOrderHistoryQuery(Container $container)
    {
        $container[static::QUERY_EXPORTED_ORDER_HISTORY] = static function () {
            return new FooExportedOrderHistoryQuery();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addExportedOrderQuery(Container $container)
    {
        $container[static::QUERY_EXPORTED_ORDER] = static function () {
            return new FooExportedOrderQuery();
        };

        return $container;
    }
}
