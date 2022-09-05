<?php

namespace FondOfOryx\Zed\ErpOrder;

use ArrayObject;
use FondOfOryx\Zed\ErpOrder\Dependency\Facade\ErpOrderToCompanyBusinessUnitFacadeBridge;
use FondOfOryx\Zed\ErpOrder\Dependency\Facade\ErpOrderToCountryFacadeBridge;
use FondOfOryx\Zed\ErpOrder\Exception\WrongInterfaceException;
use FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderAddressPostSavePluginInterface;
use FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderAddressPreSavePluginInterface;
use FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderItemPostSavePluginInterface;
use FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderItemPreSavePluginInterface;
use FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderPostSavePluginInterface;
use FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderPreSavePluginInterface;
use FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderTotalPostSavePluginInterface;
use FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderTotalPreSavePluginInterface;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class ErpOrderDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_COMPANY_BUSINESS_UNIT = 'FACADE_COMPANY_BUSINESS_UNIT';

    /**
     * @var string
     */
    public const FACADE_COUNTRY = 'FACADE_COUNTRY';

    /**
     * @var string
     */
    public const PLUGIN_ERP_ORDER_PRE_SAVE = 'PLUGIN_ERP_ORDER_PRE_SAVE';

    /**
     * @var string
     */
    public const PLUGIN_ERP_ORDER_POST_SAVE = 'PLUGIN_ERP_ORDER_POST_SAVE';

    /**
     * @var string
     */
    public const PLUGIN_ERP_ORDER_ITEM_POST_SAVE = 'PLUGIN_ERP_ORDER_ITEM_POST_SAVE';

    /**
     * @var string
     */
    public const PLUGIN_ERP_ORDER_ITEM_PRE_SAVE = 'PLUGIN_ERP_ORDER_ITEM_PRE_SAVE';

    /**
     * @var string
     */
    public const PLUGIN_ERP_ORDER_ADDRESS_POST_SAVE = 'PLUGIN_ERP_ORDER_ADDRESS_POST_SAVE';

    /**
     * @var string
     */
    public const PLUGIN_ERP_ORDER_ADDRESS_PRE_SAVE = 'PLUGIN_ERP_ORDER_ADDRESS_PRE_SAVE';

    /**
     * @var string
     */
    public const PLUGIN_ERP_ORDER_TOTAL_POST_SAVE = 'PLUGIN_ERP_ORDER_TOTAL_POST_SAVE';

    /**
     * @var string
     */
    public const PLUGIN_ERP_ORDER_TOTAL_PRE_SAVE = 'PLUGIN_ERP_ORDER_TOTAL_PRE_SAVE';

    /**
     * @var string
     */
    public const PLUGIN_ERP_ORDER_TOTALS_POST_SAVE = 'PLUGIN_ERP_ORDER_TOTALS_POST_SAVE';

    /**
     * @var string
     */
    public const PLUGIN_ERP_ORDER_TOTALS_PRE_SAVE = 'PLUGIN_ERP_ORDER_TOTALS_PRE_SAVE';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container): Container
    {
        $container = parent::providePersistenceLayerDependencies($container);

        $container = $this->addCompanyBusinessUnitFacade($container);

        return $this->addCountryFacade($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::providePersistenceLayerDependencies($container);

        $container = $this->addErpOrderPreSavePlugin($container);
        $container = $this->addErpOrderPostSavePlugin($container);
        $container = $this->addErpOrderItemPreSavePlugin($container);
        $container = $this->addErpOrderItemPostSavePlugin($container);
        $container = $this->addErpOrderAddressPreSavePlugin($container);
        $container = $this->addErpOrderAddressPostSavePlugin($container);
        $container = $this->addErpOrderTotalPreSavePlugin($container);
        $container = $this->addErpOrderTotalPostSavePlugin($container);
        $container = $this->addErpOrderTotalsPreSavePlugin($container);

        return $this->addErpOrderTotalsPostSavePlugin($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addCompanyBusinessUnitFacade(Container $container): Container
    {
        $container[static::FACADE_COMPANY_BUSINESS_UNIT] = static function (Container $container) {
            return new ErpOrderToCompanyBusinessUnitFacadeBridge(
                $container->getLocator()->companyBusinessUnit()->facade(),
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addCountryFacade(Container $container): Container
    {
        $container[static::FACADE_COUNTRY] = static function (Container $container) {
            return new ErpOrderToCountryFacadeBridge(
                $container->getLocator()->country()->facade(),
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addErpOrderPostSavePlugin(Container $container): Container
    {
        $container[static::PLUGIN_ERP_ORDER_POST_SAVE] = function () {
            $plugins = $this->getErpOrderPostSavePlugin();
            $this->validatePlugin($plugins, ErpOrderPostSavePluginInterface::class);

            return new ArrayObject($plugins);
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addErpOrderPreSavePlugin(Container $container): Container
    {
        $container[static::PLUGIN_ERP_ORDER_PRE_SAVE] = function () {
            $plugins = $this->getErpOrderPreSavePlugin();
            $this->validatePlugin($plugins, ErpOrderPreSavePluginInterface::class);

            return new ArrayObject($plugins);
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addErpOrderItemPostSavePlugin(Container $container): Container
    {
        $container[static::PLUGIN_ERP_ORDER_ITEM_POST_SAVE] = function () {
            $plugins = $this->getErpOrderItemPostSavePlugin();
            $this->validatePlugin($plugins, ErpOrderItemPostSavePluginInterface::class);

            return new ArrayObject($plugins);
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addErpOrderItemPreSavePlugin(Container $container): Container
    {
        $container[static::PLUGIN_ERP_ORDER_ITEM_PRE_SAVE] = function () {
            $plugins = $this->getErpOrderItemPreSavePlugin();
            $this->validatePlugin($plugins, ErpOrderItemPreSavePluginInterface::class);

            return new ArrayObject($plugins);
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addErpOrderAddressPostSavePlugin(Container $container): Container
    {
        $container[static::PLUGIN_ERP_ORDER_ADDRESS_POST_SAVE] = function () {
            $plugins = $this->getErpOrderAddressPostSavePlugin();
            $this->validatePlugin($plugins, ErpOrderAddressPostSavePluginInterface::class);

            return new ArrayObject($plugins);
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addErpOrderAddressPreSavePlugin(Container $container): Container
    {
        $container[static::PLUGIN_ERP_ORDER_ADDRESS_PRE_SAVE] = function () {
            $plugins = $this->getErpOrderAddressPreSavePlugin();
            $this->validatePlugin($plugins, ErpOrderAddressPreSavePluginInterface::class);

            return new ArrayObject($plugins);
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addErpOrderTotalPostSavePlugin(Container $container): Container
    {
        $container[static::PLUGIN_ERP_ORDER_TOTAL_POST_SAVE] = function () {
            $plugins = $this->getErpOrderTotalPostSavePlugin();
            $this->validatePlugin($plugins, ErpOrderTotalPostSavePluginInterface::class);

            return new ArrayObject($plugins);
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addErpOrderTotalPreSavePlugin(Container $container): Container
    {
        $container[static::PLUGIN_ERP_ORDER_TOTAL_PRE_SAVE] = function () {
            $plugins = $this->getErpOrderTotalPreSavePlugin();
            $this->validatePlugin($plugins, ErpOrderTotalPreSavePluginInterface::class);

            return new ArrayObject($plugins);
        };

        return $container;
    }

    /**
     * @param array $plugins
     * @param string $class
     *
     * @throws \FondOfOryx\Zed\ErpOrder\Exception\WrongInterfaceException
     *
     * @return void
     */
    protected function validatePlugin(array $plugins, string $class): void
    {
        foreach ($plugins as $plugin) {
            if (($plugin instanceof $class) === false) {
                throw new WrongInterfaceException(sprintf(
                    'Plugin %s has to implement interface from type %s',
                    get_class($plugin),
                    $class,
                ));
            }
        }
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderPostSavePluginInterface>
     */
    protected function getErpOrderPostSavePlugin(): array
    {
        return [];
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderPreSavePluginInterface>
     */
    protected function getErpOrderPreSavePlugin(): array
    {
        return [];
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderItemPostSavePluginInterface>
     */
    protected function getErpOrderItemPostSavePlugin(): array
    {
        return [];
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderItemPreSavePluginInterface>
     */
    protected function getErpOrderItemPreSavePlugin(): array
    {
        return [];
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderAddressPostSavePluginInterface>
     */
    protected function getErpOrderAddressPostSavePlugin(): array
    {
        return [];
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderAddressPreSavePluginInterface>
     */
    protected function getErpOrderAddressPreSavePlugin(): array
    {
        return [];
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderTotalPostSavePluginInterface>
     */
    protected function getErpOrderTotalPostSavePlugin(): array
    {
        return [];
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderTotalPreSavePluginInterface>
     */
    protected function getErpOrderTotalPreSavePlugin(): array
    {
        return [];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addErpOrderTotalsPreSavePlugin(Container $container): Container
    {
        $self = $this;

        $container[static::PLUGIN_ERP_ORDER_TOTALS_PRE_SAVE] = static function () use ($self) {
            return $self->getErpOrderTotalsPreSavePlugin();
        };

        return $container;
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderTotalsPreSavePluginInterface>
     */
    protected function getErpOrderTotalsPreSavePlugin(): array
    {
        return [];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addErpOrderTotalsPostSavePlugin(Container $container): Container
    {
        $self = $this;

        $container[static::PLUGIN_ERP_ORDER_TOTALS_POST_SAVE] = static function () use ($self) {
            return $self->getErpOrderTotalsPostSavePlugin();
        };

        return $container;
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderTotalsPostSavePluginInterface>
     */
    protected function getErpOrderTotalsPostSavePlugin(): array
    {
        return [];
    }
}
