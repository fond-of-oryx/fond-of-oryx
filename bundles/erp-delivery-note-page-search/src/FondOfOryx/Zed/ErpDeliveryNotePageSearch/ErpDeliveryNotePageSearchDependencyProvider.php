<?php

namespace FondOfOryx\Zed\ErpDeliveryNotePageSearch;

use FondOfOryx\Zed\ErpDeliveryNotePageSearch\Dependency\Facade\ErpDeliveryNotePageSearchToEventBehaviorFacadeBridge;
use FondOfOryx\Zed\ErpDeliveryNotePageSearch\Dependency\Service\ErpDeliveryNotePageSearchToUtilEncodingServiceBridge;
use Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteQuery;
use Orm\Zed\ErpDeliveryNotePageSearch\Persistence\FooErpDeliveryNotePageSearchQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfOryx\Zed\ErpDeliveryNotePageSearch\ErpDeliveryNotePageSearchConfig getConfig()
 */
class ErpDeliveryNotePageSearchDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_EVENT_BEHAVIOR = 'FACADE_EVENT_BEHAVIOR';

    /**
     * @var string
     */
    public const PLUGINS_FULL_TEXT_EXPANDER = 'PLUGINS_FULL_TEXT_EXPANDER';

    /**
     * @var string
     */
    public const PLUGINS_FULL_TEXT_BOOSTED_EXPANDER = 'PLUGINS_FULL_TEXT_BOOSTED_EXPANDER';

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
    public const SERVICE_UTIL_ENCODING = 'SERVICE_UTIL_ENCODING';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addFullTextExpanderPlugins($container);
        $container = $this->addFullTextBoostedExpanderPlugins($container);

        return $this->addUtilEncodingService($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container): Container
    {
        $container = parent::provideCommunicationLayerDependencies($container);

        return $this->addEventBehaviorFacade($container);
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

        return $this->addErpDeliveryNoteQuery($container);
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

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addFullTextExpanderPlugins(Container $container): Container
    {
        $container[static::PLUGINS_FULL_TEXT_EXPANDER] = function () {
            return $this->getFullTextExpanderPlugins();
        };

        return $container;
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpDeliveryNotePageSearchExtension\Dependency\Plugin\FullTextExpanderPluginInterface>
     */
    protected function getFullTextExpanderPlugins(): array
    {
        return [];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addFullTextBoostedExpanderPlugins(Container $container): Container
    {
        $container[static::PLUGINS_FULL_TEXT_BOOSTED_EXPANDER] = function () {
            return $this->getFullTextBoostedExpanderPlugins();
        };

        return $container;
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpDeliveryNotePageSearchExtension\Dependency\Plugin\FullTextExpanderPluginInterface>
     */
    protected function getFullTextBoostedExpanderPlugins(): array
    {
        return [];
    }
}
