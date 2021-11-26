<?php

namespace FondOfOryx\Zed\ErpInvoice;

use ArrayObject;
use FondOfOryx\Zed\ErpInvoice\Dependency\Facade\ErpInvoiceToCompanyBusinessUnitFacadeBridge;
use FondOfOryx\Zed\ErpInvoice\Dependency\Facade\ErpInvoiceToCountryFacadeBridge;
use FondOfOryx\Zed\ErpInvoice\Exception\WrongInterfaceException;
use FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoiceAddressPostSavePluginInterface;
use FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoiceAddressPreSavePluginInterface;
use FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoiceAmountPostSavePluginInterface;
use FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoiceAmountPreSavePluginInterface;
use FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoiceExpensePostSavePluginInterface;
use FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoiceExpensePreSavePluginInterface;
use FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoiceItemPostSavePluginInterface;
use FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoiceItemPreSavePluginInterface;
use FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoicePostSavePluginInterface;
use FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoicePreSavePluginInterface;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class ErpInvoiceDependencyProvider extends AbstractBundleDependencyProvider
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
    public const PLUGIN_ERP_INVOICE_PRE_SAVE = 'PLUGIN_ERP_INVOICE_PRE_SAVE';

    /**
     * @var string
     */
    public const PLUGIN_ERP_INVOICE_POST_SAVE = 'PLUGIN_ERP_INVOICE_POST_SAVE';

    /**
     * @var string
     */
    public const PLUGIN_ERP_INVOICE_ITEM_POST_SAVE = 'PLUGIN_ERP_INVOICE_ITEM_POST_SAVE';

    /**
     * @var string
     */
    public const PLUGIN_ERP_INVOICE_ITEM_PRE_SAVE = 'PLUGIN_ERP_INVOICE_ITEM_PRE_SAVE';

    /**
     * @var string
     */
    public const PLUGIN_ERP_INVOICE_EXPENSE_POST_SAVE = 'PLUGIN_ERP_INVOICE_EXPENSE_POST_SAVE';

    /**
     * @var string
     */
    public const PLUGIN_ERP_INVOICE_EXPENSE_PRE_SAVE = 'PLUGIN_ERP_INVOICE_EXPENSE_PRE_SAVE';

    /**
     * @var string
     */
    public const PLUGIN_ERP_INVOICE_ADDRESS_POST_SAVE = 'PLUGIN_ERP_INVOICE_ADDRESS_POST_SAVE';

    /**
     * @var string
     */
    public const PLUGIN_ERP_INVOICE_ADDRESS_PRE_SAVE = 'PLUGIN_ERP_INVOICE_ADDRESS_PRE_SAVE';

    /**
     * @var string
     */
    public const PLUGIN_ERP_INVOICE_AMOUNT_POST_SAVE = 'PLUGIN_ERP_INVOICE_AMOUNT_POST_SAVE';

    /**
     * @var string
     */
    public const PLUGIN_ERP_INVOICE_AMOUNT_PRE_SAVE = 'PLUGIN_ERP_INVOICE_AMOUNT_PRE_SAVE';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container)
    {
        $container = parent::providePersistenceLayerDependencies($container);
        $container = $this->addCompanyBusinessUnitFacade($container);
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
        $container = $this->addErpInvoicePreSavePlugin($container);
        $container = $this->addErpInvoicePostSavePlugin($container);
        $container = $this->addErpInvoiceItemPreSavePlugin($container);
        $container = $this->addErpInvoiceItemPostSavePlugin($container);
        $container = $this->addErpInvoiceExpensePreSavePlugin($container);
        $container = $this->addErpInvoiceExpensePostSavePlugin($container);
        $container = $this->addErpInvoiceAddressPreSavePlugin($container);
        $container = $this->addErpInvoiceAddressPostSavePlugin($container);
        $container = $this->addErpInvoiceAmountPreSavePlugin($container);
        $container = $this->addErpInvoiceAmountPostSavePlugin($container);

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
            return new ErpInvoiceToCompanyBusinessUnitFacadeBridge(
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
        $container[static::FACADE_COUNTRY] = function (Container $container) {
            return new ErpInvoiceToCountryFacadeBridge(
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
    public function addErpInvoicePostSavePlugin(Container $container): Container
    {
        $container[static::PLUGIN_ERP_INVOICE_POST_SAVE] = function (Container $container) {
            $plugins = $this->getErpInvoicePostSavePlugin();
            $this->validatePlugin($plugins, ErpInvoicePostSavePluginInterface::class);

            return new ArrayObject($plugins);
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addErpInvoicePreSavePlugin(Container $container): Container
    {
        $container[static::PLUGIN_ERP_INVOICE_PRE_SAVE] = function (Container $container) {
            $plugins = $this->getErpInvoicePreSavePlugin();
            $this->validatePlugin($plugins, ErpInvoicePreSavePluginInterface::class);

            return new ArrayObject($plugins);
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addErpInvoiceItemPostSavePlugin(Container $container): Container
    {
        $container[static::PLUGIN_ERP_INVOICE_ITEM_POST_SAVE] = function (Container $container) {
            $plugins = $this->getErpInvoiceItemPostSavePlugin();
            $this->validatePlugin($plugins, ErpInvoiceItemPostSavePluginInterface::class);

            return new ArrayObject($plugins);
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addErpInvoiceItemPreSavePlugin(Container $container): Container
    {
        $container[static::PLUGIN_ERP_INVOICE_ITEM_PRE_SAVE] = function (Container $container) {
            $plugins = $this->getErpInvoiceItemPreSavePlugin();
            $this->validatePlugin($plugins, ErpInvoiceItemPreSavePluginInterface::class);

            return new ArrayObject($plugins);
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addErpInvoiceExpensePostSavePlugin(Container $container): Container
    {
        $container[static::PLUGIN_ERP_INVOICE_EXPENSE_POST_SAVE] = function (Container $container) {
            $plugins = $this->getErpInvoiceExpensePostSavePlugin();
            $this->validatePlugin($plugins, ErpInvoiceExpensePostSavePluginInterface::class);

            return new ArrayObject($plugins);
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addErpInvoiceExpensePreSavePlugin(Container $container): Container
    {
        $container[static::PLUGIN_ERP_INVOICE_EXPENSE_PRE_SAVE] = function (Container $container) {
            $plugins = $this->getErpInvoiceExpensePreSavePlugin();
            $this->validatePlugin($plugins, ErpInvoiceExpensePreSavePluginInterface::class);

            return new ArrayObject($plugins);
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addErpInvoiceAddressPostSavePlugin(Container $container): Container
    {
        $container[static::PLUGIN_ERP_INVOICE_ADDRESS_POST_SAVE] = function (Container $container) {
            $plugins = $this->getErpInvoiceAddressPostSavePlugin();
            $this->validatePlugin($plugins, ErpInvoiceAddressPostSavePluginInterface::class);

            return new ArrayObject($plugins);
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addErpInvoiceAddressPreSavePlugin(Container $container): Container
    {
        $container[static::PLUGIN_ERP_INVOICE_ADDRESS_PRE_SAVE] = function (Container $container) {
            $plugins = $this->getErpInvoiceAddressPreSavePlugin();
            $this->validatePlugin($plugins, ErpInvoiceAddressPreSavePluginInterface::class);

            return new ArrayObject($plugins);
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addErpInvoiceAmountPostSavePlugin(Container $container): Container
    {
        $container[static::PLUGIN_ERP_INVOICE_AMOUNT_POST_SAVE] = function (Container $container) {
            $plugins = $this->getErpInvoiceAmountPostSavePlugin();
            $this->validatePlugin($plugins, ErpInvoiceAmountPostSavePluginInterface::class);

            return new ArrayObject($plugins);
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addErpInvoiceAmountPreSavePlugin(Container $container): Container
    {
        $container[static::PLUGIN_ERP_INVOICE_AMOUNT_PRE_SAVE] = function (Container $container) {
            $plugins = $this->getErpInvoiceAmountPreSavePlugin();
            $this->validatePlugin($plugins, ErpInvoiceAmountPreSavePluginInterface::class);

            return new ArrayObject($plugins);
        };

        return $container;
    }

    /**
     * @param array $plugins
     * @param string $class
     *
     * @throws \FondOfOryx\Zed\ErpInvoice\Exception\WrongInterfaceException
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
     * @return array<\FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoicePostSavePluginInterface>
     */
    protected function getErpInvoicePostSavePlugin(): array
    {
        return [];
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoicePreSavePluginInterface>
     */
    protected function getErpInvoicePreSavePlugin(): array
    {
        return [];
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoiceItemPostSavePluginInterface>
     */
    protected function getErpInvoiceItemPostSavePlugin(): array
    {
        return [];
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoiceExpensePostSavePluginInterface>
     */
    protected function getErpInvoiceExpensePostSavePlugin(): array
    {
        return [];
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoiceItemPreSavePluginInterface>
     */
    protected function getErpInvoiceItemPreSavePlugin(): array
    {
        return [];
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoiceExpensePreSavePluginInterface>
     */
    protected function getErpInvoiceExpensePreSavePlugin(): array
    {
        return [];
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoiceAddressPostSavePluginInterface>
     */
    protected function getErpInvoiceAddressPostSavePlugin(): array
    {
        return [];
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoiceAddressPreSavePluginInterface>
     */
    protected function getErpInvoiceAddressPreSavePlugin(): array
    {
        return [];
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoiceAmountPostSavePluginInterface>
     */
    protected function getErpInvoiceAmountPostSavePlugin(): array
    {
        return [];
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoiceAmountPreSavePluginInterface>
     */
    protected function getErpInvoiceAmountPreSavePlugin(): array
    {
        return [];
    }
}
