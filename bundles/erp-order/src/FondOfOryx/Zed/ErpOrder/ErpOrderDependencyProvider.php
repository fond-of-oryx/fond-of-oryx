<?php

namespace FondOfOryx\Zed\ErpOrder;

use ArrayObject;
use FondOfOryx\Zed\ErpOrder\Dependency\Facade\ErpOrderToCompanyBusinessUnitFacadeBridge;
use FondOfOryx\Zed\ErpOrder\Dependency\Facade\ErpOrderToCompanyUserFacadeBridge;
use FondOfOryx\Zed\ErpOrder\Dependency\Facade\ErpOrderToCountryFacadeBridge;
use FondOfOryx\Zed\ErpOrder\Exception\WrongInterfaceException;
use FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderAddressPostSavePluginInterface;
use FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderAddressPreSavePluginInterface;
use FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderItemPostSavePluginInterface;
use FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderItemPreSavePluginInterface;
use FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderPostSavePluginInterface;
use FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderPreSavePluginInterface;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class ErpOrderDependencyProvider extends AbstractBundleDependencyProvider
{
    public const FACADE_COMPANY_BUSINESS_UNIT = 'FACADE_COMPANY_BUSINESS_UNIT';
    public const FACADE_COMPANY_USER = 'FACADE_COMPANY_USER';
    public const FACADE_COUNTRY = 'FACADE_COUNTRY';
    public const PLUGIN_ERP_ORDER_PRE_SAVE = 'PLUGIN_ERP_ORDER_PRE_SAVE';
    public const PLUGIN_ERP_ORDER_POST_SAVE = 'PLUGIN_ERP_ORDER_POST_SAVE';
    public const PLUGIN_ERP_ORDER_ITEM_POST_SAVE = 'PLUGIN_ERP_ORDER_ITEM_POST_SAVE';
    public const PLUGIN_ERP_ORDER_ITEM_PRE_SAVE = 'PLUGIN_ERP_ORDER_ITEM_PRE_SAVE';
    public const PLUGIN_ERP_ORDER_ADDRESS_POST_SAVE = 'PLUGIN_ERP_ORDER_ADDRESS_POST_SAVE';
    public const PLUGIN_ERP_ORDER_ADDRESS_PRE_SAVE = 'PLUGIN_ERP_ORDER_ADDRESS_PRE_SAVE';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container)
    {
        $container = parent::providePersistenceLayerDependencies($container);
        $container = $this->addCompanyBusinessUnitFacade($container);
        $container = $this->addCompanyUserFacade($container);
        $container = $this->addCountryFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container)
    {
        $container = parent::providePersistenceLayerDependencies($container);
        $container = $this->addErpOrderPreSavePlugin($container);
        $container = $this->addErpOrderPostSavePlugin($container);
        $container = $this->addErpOrderItemPreSavePlugin($container);
        $container = $this->addErpOrderItemPostSavePlugin($container);
        $container = $this->addErpOrderAddressPreSavePlugin($container);
        $container = $this->addErpOrderAddressPostSavePlugin($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addCompanyBusinessUnitFacade(Container $container): Container
    {
        $container[static::FACADE_COMPANY_BUSINESS_UNIT] = function (Container $container) {
            return new ErpOrderToCompanyBusinessUnitFacadeBridge(
                $container->getLocator()->companyBusinessUnit()->facade()
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addCompanyUserFacade(Container $container): Container
    {
        $container[static::FACADE_COMPANY_USER] = function (Container $container) {
            return new ErpOrderToCompanyUserFacadeBridge(
                $container->getLocator()->companyUser()->facade()
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
        $container[static::FACADE_COUNTRY] = function (Container $container) {
            return new ErpOrderToCountryFacadeBridge(
                $container->getLocator()->country()->facade()
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
        $container[static::PLUGIN_ERP_ORDER_POST_SAVE] = function (Container $container) {
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
        $container[static::PLUGIN_ERP_ORDER_PRE_SAVE] = function (Container $container) {
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
        $container[static::PLUGIN_ERP_ORDER_ITEM_POST_SAVE] = function (Container $container) {
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
        $container[static::PLUGIN_ERP_ORDER_ITEM_PRE_SAVE] = function (Container $container) {
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
        $container[static::PLUGIN_ERP_ORDER_ADDRESS_POST_SAVE] = function (Container $container) {
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
        $container[static::PLUGIN_ERP_ORDER_ADDRESS_PRE_SAVE] = function (Container $container) {
            $plugins = $this->getErpOrderAddressPreSavePlugin();
            $this->validatePlugin($plugins, ErpOrderAddressPreSavePluginInterface::class);

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
                    $class
                ));
            }
        }
    }

    /**
     * @return \FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderPostSavePluginInterface[]
     */
    protected function getErpOrderPostSavePlugin(): array
    {
        return [];
    }

    /**
     * @return \FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderPreSavePluginInterface[]
     */
    protected function getErpOrderPreSavePlugin(): array
    {
        return [];
    }

    /**
     * @return \FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderItemPostSavePluginInterface[]
     */
    protected function getErpOrderItemPostSavePlugin(): array
    {
        return [];
    }

    /**
     * @return \FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderItemPreSavePluginInterface[]
     */
    protected function getErpOrderItemPreSavePlugin(): array
    {
        return [];
    }

    /**
     * @return \FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderAddressPostSavePluginInterface[]
     */
    protected function getErpOrderAddressPostSavePlugin(): array
    {
        return [];
    }

    /**
     * @return \FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderAddressPreSavePluginInterface[]
     */
    protected function getErpOrderAddressPreSavePlugin(): array
    {
        return [];
    }
}
