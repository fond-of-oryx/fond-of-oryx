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
            $collection = new ArrayObject();
            foreach ($this->getErpOrderPostSavePlugin() as $postSavePlugin) {
                if ($postSavePlugin instanceof ErpOrderPostSavePluginInterface) {
                    $collection->append($postSavePlugin);

                    continue;
                } else {
                    $this->throwWrongInterfaceException(
                        get_class($postSavePlugin),
                        ErpOrderPostSavePluginInterface::class
                    );
                }
            }

            return $collection;
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
            $collection = new ArrayObject();
            foreach ($this->getErpOrderPreSavePlugin() as $preSavePlugin) {
                if ($preSavePlugin instanceof ErpOrderPreSavePluginInterface) {
                    $collection->append($preSavePlugin);

                    continue;
                } else {
                    $this->throwWrongInterfaceException(
                        get_class($preSavePlugin),
                        ErpOrderPreSavePluginInterface::class
                    );
                }
            }

            return $collection;
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
            $collection = new ArrayObject();
            foreach ($this->getErpOrderItemPostSavePlugin() as $postSavePlugin) {
                if ($postSavePlugin instanceof ErpOrderItemPostSavePluginInterface) {
                    $collection->append($postSavePlugin);

                    continue;
                } else {
                    $this->throwWrongInterfaceException(
                        get_class($postSavePlugin),
                        ErpOrderItemPostSavePluginInterface::class
                    );
                }
            }

            return $collection;
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
            $collection = new ArrayObject();
            foreach ($this->getErpOrderItemPreSavePlugin() as $preSavePlugin) {
                if ($preSavePlugin instanceof ErpOrderItemPreSavePluginInterface) {
                    $collection->append($preSavePlugin);

                    continue;
                } else {
                    $this->throwWrongInterfaceException(
                        get_class($preSavePlugin),
                        ErpOrderItemPreSavePluginInterface::class
                    );
                }
            }

            return $collection;
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
            $collection = new ArrayObject();
            foreach ($this->getErpOrderAddressPostSavePlugin() as $postSavePlugin) {
                if ($postSavePlugin instanceof ErpOrderAddressPostSavePluginInterface) {
                    $collection->append($postSavePlugin);

                    continue;
                } else {
                    $this->throwWrongInterfaceException(
                        get_class($postSavePlugin),
                        ErpOrderAddressPostSavePluginInterface::class
                    );
                }
            }

            return $collection;
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
            $collection = new ArrayObject();
            foreach ($this->getErpOrderAddressPreSavePlugin() as $preSavePlugin) {
                if ($preSavePlugin instanceof ErpOrderAddressPreSavePluginInterface) {
                    $collection->append($preSavePlugin);

                    continue;
                } else {
                    $this->throwWrongInterfaceException(
                        get_class($preSavePlugin),
                        ErpOrderAddressPreSavePluginInterface::class
                    );
                }
            }

            return $collection;
        };

        return $container;
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

    /**
     * @param string $class
     * @param string $rightInterface
     *
     * @throws \FondOfOryx\Zed\ErpOrder\Exception\WrongInterfaceException
     *
     * @return void
     */
    protected function throwWrongInterfaceException(string $class, string $rightInterface): void
    {
        throw new WrongInterfaceException(sprintf(
            'Plugin %s has to implement interface from type %s',
            $class,
            $rightInterface
        ));
    }
}
