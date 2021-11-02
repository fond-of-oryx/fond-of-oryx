<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch;

use FondOfOryx\Zed\ErpOrderPageSearch\Dependency\Facade\ErpOrderPageSearchToEventBehaviorFacadeBridge;
use FondOfOryx\Zed\ErpOrderPageSearch\Dependency\Service\ErpOrderPageSearchToUtilEncodingServiceBridge;
use Orm\Zed\ErpOrder\Persistence\ErpOrderQuery;
use Orm\Zed\ErpOrderPageSearch\Persistence\FooErpOrderPageSearchQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

/**
 * @method \FondOfOryx\Zed\ErpOrderPageSearch\ErpOrderPageSearchConfig getConfig()
 */
class ErpOrderPageSearchDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const SERVICE_UTIL_ENCODING = 'SERVICE_UTIL_ENCODING';

    /**
     * @var string
     */
    public const QUERY_ERP_ORDER_PAGE_SEARCH = 'QUERY_ERP_ORDER_PAGE_SEARCH';

    /**
     * @var string
     */
    public const QUERY_ERP_ORDER = 'QUERY_ERP_ORDER';

    /**
     * @var string
     */
    public const FACADE_EVENT_BEHAVIOR = 'FACADE_EVENT_BEHAVIOR';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addUtilEncodingService($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container): Container
    {
        $container = parent::provideCommunicationLayerDependencies($container);

        $container = $this->addEventBehaviorFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container): Container
    {
        $container = parent::providePersistenceLayerDependencies($container);

        $container = $this->addErpOrderPageSearchQuery($container);
        $container = $this->addErpOrderQuery($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addUtilEncodingService(Container $container): Container
    {
        $container[static::SERVICE_UTIL_ENCODING] = static function (Container $container) {
            return new ErpOrderPageSearchToUtilEncodingServiceBridge(
                $container->getLocator()->utilEncoding()->service(),
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addEventBehaviorFacade(Container $container): Container
    {
        $container[static::FACADE_EVENT_BEHAVIOR] = static function (Container $container) {
            return new ErpOrderPageSearchToEventBehaviorFacadeBridge(
                $container->getLocator()->eventBehavior()->facade(),
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addErpOrderPageSearchQuery(Container $container): Container
    {
        $container[static::QUERY_ERP_ORDER_PAGE_SEARCH] = static function () {
            return FooErpOrderPageSearchQuery::create();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addErpOrderQuery(Container $container): Container
    {
        $container[static::QUERY_ERP_ORDER] = static function () {
            return ErpOrderQuery::create();
        };

        return $container;
    }
}
