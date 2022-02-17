<?php

namespace FondOfOryx\Zed\ErpDeliveryNotePageSearch;

use FondOfOryx\Zed\ErpDeliveryNotePageSearch\Dependency\Facade\ErpDeliveryNotePageSearchToEventBehaviorFacadeBridge;
use FondOfOryx\Zed\ErpDeliveryNotePageSearch\Dependency\Service\ErpDeliveryNotePageSearchToUtilEncodingServiceBridge;
use Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteQuery;
use Orm\Zed\ErpDeliveryNotePageSearch\Persistence\FooErpDeliveryNotePageSearchQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

/**
 * @method \FondOfOryx\Zed\ErpDeliveryNotePageSearch\ErpDeliveryNotePageSearchConfig getConfig()
 */
class ErpDeliveryNotePageSearchDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const SERVICE_UTIL_ENCODING = 'SERVICE_UTIL_ENCODING';

    /**
     * @var string
     */
    public const QUERY_ERP_DELIVERY_NOTE_PAGE_SEARCH = 'QUERY_ERP_DELIVERY_NOTE_PAGE_SEARCH';

    /**
     * @var string
     */
    public const QUERY_ERP_DELIVERY_NOTE = 'QUERY_ERP_DELIVERY_NOTE';

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

        $container = $this->addErpDeliveryNotePageSearchQuery($container);
        $container = $this->addErpDeliveryNoteQuery($container);

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
            return new ErpDeliveryNotePageSearchToUtilEncodingServiceBridge(
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
            return new ErpDeliveryNotePageSearchToEventBehaviorFacadeBridge(
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
    protected function addErpDeliveryNotePageSearchQuery(Container $container): Container
    {
        $container[static::QUERY_ERP_DELIVERY_NOTE_PAGE_SEARCH] = static function () {
            return FooErpDeliveryNotePageSearchQuery::create();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addErpDeliveryNoteQuery(Container $container): Container
    {
        $container[static::QUERY_ERP_DELIVERY_NOTE] = static function () {
            return FooErpDeliveryNoteQuery::create();
        };

        return $container;
    }
}
