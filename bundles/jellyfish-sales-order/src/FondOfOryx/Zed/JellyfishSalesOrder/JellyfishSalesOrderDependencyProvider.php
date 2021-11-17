<?php

namespace FondOfOryx\Zed\JellyfishSalesOrder;

use FondOfOryx\Zed\JellyfishSalesOrder\Dependency\Facade\JellyfishSalesOrderToOmsFacadeBridge;
use FondOfOryx\Zed\JellyfishSalesOrder\Dependency\Facade\JellyfishSalesOrderToStoreFacadeBridge;
use FondOfOryx\Zed\JellyfishSalesOrder\Dependency\Service\JellyfishSalesOrderToUtilEncodingServiceBridge;
use Orm\Zed\Oms\Persistence\Base\SpyOmsOrderItemStateQuery;
use Orm\Zed\Sales\Persistence\Base\SpySalesOrderQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class JellyfishSalesOrderDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_OMS = 'FACADE_OMS';

    /**
     * @var string
     */
    public const FACADE_STORE = 'FACADE_STORE';

    /**
     * @var string
     */
    public const PLUGINS_JELLYFISH_ORDER_ADDRESS_EXPANDER_POST_MAP = 'PLUGINS_JELLYFISH_ORDER_ADDRESS_EXPANDER_POST_MAP';

    /**
     * @var string
     */
    public const PLUGINS_JELLYFISH_ORDER_BEFORE_EXPORT = 'PLUGINS_JELLYFISH_ORDER_BEFORE_EXPORT';

    /**
     * @var string
     */
    public const PLUGINS_JELLYFISH_ORDER_EXPANDER_POST_MAP = 'PLUGINS_JELLYFISH_ORDER_EXPANDER_POST_MAP';

    /**
     * @var string
     */
    public const PLUGINS_JELLYFISH_ORDER_POST_MAP = 'PLUGINS_JELLYFISH_ORDER_POST_MAP';

    /**
     * @var string
     */
    public const PLUGINS_JELLYFISH_ORDER_ITEM_EXPANDER_POST_MAP = 'PLUGINS_JELLYFISH_ORDER_ITEM_EXPANDER_POST_MAP';

    /**
     * @string
     *
     * @var string
     */
    public const PROPEL_QUERY_SALES_ORDER = 'PROPEL_QUERY_SALES_ORDER';

    /**
     * @string
     *
     * @var string
     */
    public const PROPEL_QUERY_OMS_ORDER_ITEM_STATE = 'PROPEL_QUERY_OMS_ORDER_ITEM_STATE';

    /**
     * @var string
     */
    public const SERVICE_UTIL_ENCODING = 'SERVICE_UTIL_ENCODING';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container): Container
    {
        $container = parent::providePersistenceLayerDependencies($container);

        $container = $this->addOmsOrderItemStateQuery($container);

        return $this->addSalesOrderQuery($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addSalesOrderQuery(Container $container): Container
    {
        $container[static::PROPEL_QUERY_SALES_ORDER] = static function () {
            return SpySalesOrderQuery::create();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addOmsOrderItemStateQuery(Container $container): Container
    {
        $container[static::PROPEL_QUERY_OMS_ORDER_ITEM_STATE] = static function () {
            return SpyOmsOrderItemStateQuery::create();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addOmsFacade($container);
        $container = $this->addStoreFacade($container);
        $container = $this->addUtilEncodingService($container);
        $container = $this->addJellyfishOrderAddressExpanderPostMapPlugins($container);
        $container = $this->addJellyfishOrderBeforeExportPlugins($container);
        $container = $this->addJellyfishOrderExpanderPostMapPlugins($container);
        $container = $this->addJellyfishOrderPostMapPlugins($container);

        return $this->addJellyfishOrderItemExpanderPostMapPlugins($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addOmsFacade(Container $container): Container
    {
        $container[static::FACADE_OMS] = static function (Container $container) {
            return new JellyfishSalesOrderToOmsFacadeBridge(
                $container->getLocator()->oms()->facade(),
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addStoreFacade(Container $container): Container
    {
        $container[static::FACADE_STORE] = static function (Container $container) {
            return new JellyfishSalesOrderToStoreFacadeBridge(
                $container->getLocator()->store()->facade(),
            );
        };

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
            return new JellyfishSalesOrderToUtilEncodingServiceBridge(
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
    protected function addJellyfishOrderAddressExpanderPostMapPlugins(Container $container): Container
    {
        $container[static::PLUGINS_JELLYFISH_ORDER_ADDRESS_EXPANDER_POST_MAP] = function () {
            return $this->getJellyfishOrderAddressExpanderPostMapPlugins();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addJellyfishOrderBeforeExportPlugins(Container $container): Container
    {
        $container[static::PLUGINS_JELLYFISH_ORDER_BEFORE_EXPORT] = function () {
            return $this->getJellyfishOrderBeforeExportPlugins();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addJellyfishOrderExpanderPostMapPlugins(Container $container): Container
    {
        $container[static::PLUGINS_JELLYFISH_ORDER_EXPANDER_POST_MAP] = function () {
            return $this->getJellyfishOrderExpanderPostMapPlugins();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addJellyfishOrderItemExpanderPostMapPlugins(Container $container): Container
    {
        $container[static::PLUGINS_JELLYFISH_ORDER_ITEM_EXPANDER_POST_MAP] = function () {
            return $this->getJellyfishOrderItemExpanderPostMapPlugins();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addJellyfishOrderPostMapPlugins(Container $container): Container
    {
        $container[static::PLUGINS_JELLYFISH_ORDER_POST_MAP] = function () {
            return $this->getJellyfishOrderPostMapPlugins();
        };

        return $container;
    }

    /**
     * @return array<\FondOfOryx\Zed\JellyfishSalesOrderExtension\Dependency\Plugin\JellyfishOrderItemExpanderPostMapPluginInterface>
     */
    protected function getJellyfishOrderAddressExpanderPostMapPlugins(): array
    {
        return [];
    }

    /**
     * @return array<\FondOfOryx\Zed\JellyfishSalesOrderExtension\Dependency\Plugin\JellyfishOrderExpanderPostMapPluginInterface>
     */
    protected function getJellyfishOrderBeforeExportPlugins(): array
    {
        return [];
    }

    /**
     * @return array<\FondOfOryx\Zed\JellyfishSalesOrderExtension\Dependency\Plugin\JellyfishOrderPostMapPluginInterface>
     */
    protected function getJellyfishOrderItemExpanderPostMapPlugins(): array
    {
        return [];
    }

    /**
     * @return array<\FondOfOryx\Zed\JellyfishSalesOrderExtension\Dependency\Plugin\JellyfishOrderExpanderPostMapPluginInterface>
     */
    protected function getJellyfishOrderExpanderPostMapPlugins(): array
    {
        return [];
    }

    /**
     * @return array<\FondOfOryx\Zed\JellyfishSalesOrderExtension\Dependency\Plugin\JellyfishOrderPostMapPluginInterface>
     */
    protected function getJellyfishOrderPostMapPlugins(): array
    {
        return [];
    }
}
