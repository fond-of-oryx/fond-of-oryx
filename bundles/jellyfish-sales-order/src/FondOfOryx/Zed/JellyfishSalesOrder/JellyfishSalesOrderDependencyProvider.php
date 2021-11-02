<?php

namespace FondOfOryx\Zed\JellyfishSalesOrder;

use FondOfOryx\Zed\JellyfishSalesOrder\Dependency\Service\JellyfishSalesOrderToUtilEncodingServiceBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class JellyfishSalesOrderDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const SERVICE_UTIL_ENCODING = 'SERVICE_UTIL_ENCODING';

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
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = $this->addUtilEncodingService($container);
        $container = $this->addJellyfishOrderAddressExpanderPostMapPlugins($container);
        $container = $this->addJellyfishOrderBeforeExportPlugins($container);
        $container = $this->addJellyfishOrderExpanderPostMapPlugins($container);
        $container = $this->addJellyfishOrderPostMapPlugins($container);
        $container = $this->addJellyfishOrderItemExpanderPostMapPlugins($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addUtilEncodingService(Container $container): Container
    {
        $container[static::SERVICE_UTIL_ENCODING] = function (Container $container) {
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
        $container[static::PLUGINS_JELLYFISH_ORDER_ADDRESS_EXPANDER_POST_MAP] = function (Container $container) {
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
        $container[static::PLUGINS_JELLYFISH_ORDER_BEFORE_EXPORT] = function (Container $container) {
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
        $container[static::PLUGINS_JELLYFISH_ORDER_EXPANDER_POST_MAP] = function (Container $container) {
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
        $container[static::PLUGINS_JELLYFISH_ORDER_ITEM_EXPANDER_POST_MAP] = function (Container $container) {
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
        $container[static::PLUGINS_JELLYFISH_ORDER_POST_MAP] = function (Container $container) {
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
