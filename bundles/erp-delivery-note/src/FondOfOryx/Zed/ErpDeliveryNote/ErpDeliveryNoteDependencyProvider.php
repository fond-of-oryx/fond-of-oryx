<?php

namespace FondOfOryx\Zed\ErpDeliveryNote;

use ArrayObject;
use FondOfOryx\Zed\ErpDeliveryNote\Dependency\Facade\ErpDeliveryNoteToCompanyBusinessUnitFacadeBridge;
use FondOfOryx\Zed\ErpDeliveryNote\Exception\WrongInterfaceException;
use FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNoteAddressPostSavePluginInterface;
use FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNoteAddressPreSavePluginInterface;
use FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNoteExpensePostSavePluginInterface;
use FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNoteExpensePreSavePluginInterface;
use FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNoteItemPostSavePluginInterface;
use FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNoteItemPreSavePluginInterface;
use FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNotePostSavePluginInterface;
use FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNotePreSavePluginInterface;
use FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNoteTrackingPostSavePluginInterface;
use FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNoteTrackingPreSavePluginInterface;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class ErpDeliveryNoteDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_COMPANY_BUSINESS_UNIT = 'FACADE_COMPANY_BUSINESS_UNIT';

    /**
     * @var string
     */
    public const PLUGIN_ERP_DELIVERY_NOTE_PRE_SAVE = 'PLUGIN_ERP_DELIVERY_NOTE_PRE_SAVE';

    /**
     * @var string
     */
    public const PLUGIN_ERP_DELIVERY_NOTE_POST_SAVE = 'PLUGIN_ERP_DELIVERY_NOTE_POST_SAVE';

    /**
     * @var string
     */
    public const PLUGIN_ERP_DELIVERY_NOTE_ITEM_POST_SAVE = 'PLUGIN_ERP_DELIVERY_NOTE_ITEM_POST_SAVE';

    /**
     * @var string
     */
    public const PLUGIN_ERP_DELIVERY_NOTE_ITEM_PRE_SAVE = 'PLUGIN_ERP_DELIVERY_NOTE_ITEM_PRE_SAVE';

    /**
     * @var string
     */
    public const PLUGIN_ERP_DELIVERY_NOTE_EXPENSE_POST_SAVE = 'PLUGIN_ERP_DELIVERY_NOTE_EXPENSE_POST_SAVE';

    /**
     * @var string
     */
    public const PLUGIN_ERP_DELIVERY_NOTE_EXPENSE_PRE_SAVE = 'PLUGIN_ERP_DELIVERY_NOTE_EXPENSE_PRE_SAVE';

    /**
     * @var string
     */
    public const PLUGIN_ERP_DELIVERY_NOTE_TRACKING_POST_SAVE = 'PLUGIN_ERP_DELIVERY_NOTE_TRACKING_POST_SAVE';

    /**
     * @var string
     */
    public const PLUGIN_ERP_DELIVERY_NOTE_TRACKING_PRE_SAVE = 'PLUGIN_ERP_DELIVERY_NOTE_TRACKING_PRE_SAVE';

    /**
     * @var string
     */
    public const PLUGIN_ERP_DELIVERY_NOTE_ADDRESS_POST_SAVE = 'PLUGIN_ERP_DELIVERY_NOTE_ADDRESS_POST_SAVE';

    /**
     * @var string
     */
    public const PLUGIN_ERP_DELIVERY_NOTE_ADDRESS_PRE_SAVE = 'PLUGIN_ERP_DELIVERY_NOTE_ADDRESS_PRE_SAVE';

    /**
     * @var string
     */
    public const PLUGIN_ERP_DELIVERY_NOTE_AMOUNT_POST_SAVE = 'PLUGIN_ERP_DELIVERY_NOTE_AMOUNT_POST_SAVE';

    /**
     * @var string
     */
    public const PLUGIN_ERP_DELIVERY_NOTE_AMOUNT_PRE_SAVE = 'PLUGIN_ERP_DELIVERY_NOTE_AMOUNT_PRE_SAVE';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container)
    {
        $container = parent::providePersistenceLayerDependencies($container);

        return  $this->addCompanyBusinessUnitFacade($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container)
    {
        $container = parent::providePersistenceLayerDependencies($container);
        $container = $this->addErpDeliveryNotePreSavePlugin($container);
        $container = $this->addErpDeliveryNotePostSavePlugin($container);
        $container = $this->addErpDeliveryNoteItemPreSavePlugin($container);
        $container = $this->addErpDeliveryNoteItemPostSavePlugin($container);
        $container = $this->addErpDeliveryNoteExpensePreSavePlugin($container);
        $container = $this->addErpDeliveryNoteExpensePostSavePlugin($container);
        $container = $this->addErpDeliveryNoteTrackingPreSavePlugin($container);
        $container = $this->addErpDeliveryNoteTrackingPostSavePlugin($container);
        $container = $this->addErpDeliveryNoteAddressPreSavePlugin($container);
        $container = $this->addErpDeliveryNoteAddressPostSavePlugin($container);

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
            return new ErpDeliveryNoteToCompanyBusinessUnitFacadeBridge(
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
    public function addErpDeliveryNotePostSavePlugin(Container $container): Container
    {
        $container[static::PLUGIN_ERP_DELIVERY_NOTE_POST_SAVE] = function (Container $container) {
            $plugins = $this->getErpDeliveryNotePostSavePlugin();
            $this->validatePlugin($plugins, ErpDeliveryNotePostSavePluginInterface::class);

            return new ArrayObject($plugins);
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addErpDeliveryNotePreSavePlugin(Container $container): Container
    {
        $container[static::PLUGIN_ERP_DELIVERY_NOTE_PRE_SAVE] = function (Container $container) {
            $plugins = $this->getErpDeliveryNotePreSavePlugin();
            $this->validatePlugin($plugins, ErpDeliveryNotePreSavePluginInterface::class);

            return new ArrayObject($plugins);
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addErpDeliveryNoteItemPostSavePlugin(Container $container): Container
    {
        $container[static::PLUGIN_ERP_DELIVERY_NOTE_ITEM_POST_SAVE] = function (Container $container) {
            $plugins = $this->getErpDeliveryNoteItemPostSavePlugin();
            $this->validatePlugin($plugins, ErpDeliveryNoteItemPostSavePluginInterface::class);

            return new ArrayObject($plugins);
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addErpDeliveryNoteItemPreSavePlugin(Container $container): Container
    {
        $container[static::PLUGIN_ERP_DELIVERY_NOTE_ITEM_PRE_SAVE] = function (Container $container) {
            $plugins = $this->getErpDeliveryNoteItemPreSavePlugin();
            $this->validatePlugin($plugins, ErpDeliveryNoteItemPreSavePluginInterface::class);

            return new ArrayObject($plugins);
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addErpDeliveryNoteExpensePostSavePlugin(Container $container): Container
    {
        $container[static::PLUGIN_ERP_DELIVERY_NOTE_EXPENSE_POST_SAVE] = function (Container $container) {
            $plugins = $this->getErpDeliveryNoteExpensePostSavePlugin();
            $this->validatePlugin($plugins, ErpDeliveryNoteExpensePostSavePluginInterface::class);

            return new ArrayObject($plugins);
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addErpDeliveryNoteExpensePreSavePlugin(Container $container): Container
    {
        $container[static::PLUGIN_ERP_DELIVERY_NOTE_EXPENSE_PRE_SAVE] = function (Container $container) {
            $plugins = $this->getErpDeliveryNoteExpensePreSavePlugin();
            $this->validatePlugin($plugins, ErpDeliveryNoteExpensePreSavePluginInterface::class);

            return new ArrayObject($plugins);
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addErpDeliveryNoteTrackingPostSavePlugin(Container $container): Container
    {
        $container[static::PLUGIN_ERP_DELIVERY_NOTE_TRACKING_POST_SAVE] = function (Container $container) {
            $plugins = $this->getErpDeliveryNoteTrackingPostSavePlugin();
            $this->validatePlugin($plugins, ErpDeliveryNoteTrackingPostSavePluginInterface::class);

            return new ArrayObject($plugins);
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addErpDeliveryNoteTrackingPreSavePlugin(Container $container): Container
    {
        $container[static::PLUGIN_ERP_DELIVERY_NOTE_TRACKING_PRE_SAVE] = function (Container $container) {
            $plugins = $this->getErpDeliveryNoteTrackingPreSavePlugin();
            $this->validatePlugin($plugins, ErpDeliveryNoteTrackingPreSavePluginInterface::class);

            return new ArrayObject($plugins);
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addErpDeliveryNoteAddressPostSavePlugin(Container $container): Container
    {
        $container[static::PLUGIN_ERP_DELIVERY_NOTE_ADDRESS_POST_SAVE] = function (Container $container) {
            $plugins = $this->getErpDeliveryNoteAddressPostSavePlugin();
            $this->validatePlugin($plugins, ErpDeliveryNoteAddressPostSavePluginInterface::class);

            return new ArrayObject($plugins);
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addErpDeliveryNoteAddressPreSavePlugin(Container $container): Container
    {
        $container[static::PLUGIN_ERP_DELIVERY_NOTE_ADDRESS_PRE_SAVE] = function (Container $container) {
            $plugins = $this->getErpDeliveryNoteAddressPreSavePlugin();
            $this->validatePlugin($plugins, ErpDeliveryNoteAddressPreSavePluginInterface::class);

            return new ArrayObject($plugins);
        };

        return $container;
    }

    /**
     * @param array $plugins
     * @param string $class
     *
     * @throws \FondOfOryx\Zed\ErpDeliveryNote\Exception\WrongInterfaceException
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
     * @return array<\FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNotePostSavePluginInterface>
     */
    protected function getErpDeliveryNotePostSavePlugin(): array
    {
        return [];
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNotePreSavePluginInterface>
     */
    protected function getErpDeliveryNotePreSavePlugin(): array
    {
        return [];
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNoteItemPostSavePluginInterface>
     */
    protected function getErpDeliveryNoteItemPostSavePlugin(): array
    {
        return [];
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNoteExpensePostSavePluginInterface>
     */
    protected function getErpDeliveryNoteExpensePostSavePlugin(): array
    {
        return [];
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNoteTrackingPostSavePluginInterface>
     */
    protected function getErpDeliveryNoteTrackingPostSavePlugin(): array
    {
        return [];
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNoteItemPreSavePluginInterface>
     */
    protected function getErpDeliveryNoteItemPreSavePlugin(): array
    {
        return [];
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNoteExpensePreSavePluginInterface>
     */
    protected function getErpDeliveryNoteExpensePreSavePlugin(): array
    {
        return [];
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNoteTrackingPreSavePluginInterface>
     */
    protected function getErpDeliveryNoteTrackingPreSavePlugin(): array
    {
        return [];
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNoteAddressPostSavePluginInterface>
     */
    protected function getErpDeliveryNoteAddressPostSavePlugin(): array
    {
        return [];
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNoteAddressPreSavePluginInterface>
     */
    protected function getErpDeliveryNoteAddressPreSavePlugin(): array
    {
        return [];
    }
}
