<?php

namespace FondOfOryx\Zed\Invoice;

use FondOfOryx\Zed\Invoice\Communication\Plugin\InvoiceExtension\AddressInvoicePreSavePlugin;
use FondOfOryx\Zed\Invoice\Communication\Plugin\InvoiceExtension\ItemsInvoicePostSavePlugin;
use FondOfOryx\Zed\Invoice\Communication\Plugin\InvoiceExtension\ReferenceInvoicePreSavePlugin;
use FondOfOryx\Zed\Invoice\Dependency\Facade\InvoiceToSequenceNumberFacadeBridge;
use FondOfOryx\Zed\Invoice\Dependency\Facade\InvoiceToStoreFacadeBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

/**
 * @method \FondOfOryx\Zed\Invoice\InvoiceConfig getConfig()
 */
class InvoiceDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_SEQUENCE_NUMBER = 'FACADE_SEQUENCE_NUMBER';

    /**
     * @var string
     */
    public const FACADE_STORE = 'FACADE_STORE';

    /**
     * @var string
     */
    public const PLUGINS_POST_SAVE = 'PLUGINS_POST_SAVE';

    /**
     * @var string
     */
    public const PLUGINS_PRE_SAVE = 'PLUGINS_PRE_SAVE';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addSequenceNumberFacade($container);
        $container = $this->addStoreFacade($container);

        $container = $this->addInvoicePreSavePlugins($container);
        $container = $this->addInvoicePostSavePlugins($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addSequenceNumberFacade(Container $container): Container
    {
        $container[static::FACADE_SEQUENCE_NUMBER] = static function (Container $container) {
            return new InvoiceToSequenceNumberFacadeBridge(
                $container->getLocator()->sequenceNumber()->facade(),
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
            return new InvoiceToStoreFacadeBridge(
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
    protected function addInvoicePreSavePlugins(Container $container): Container
    {
        $self = $this;

        $container[static::PLUGINS_PRE_SAVE] = static function () use ($self) {
            return $self->getInvoicePreSavePlugins();
        };

        return $container;
    }

    /**
     * @return array<\FondOfOryx\Zed\InvoiceExtension\Dependency\Plugin\InvoicePreSavePluginInterface>
     */
    protected function getInvoicePreSavePlugins(): array
    {
        return [
            new AddressInvoicePreSavePlugin(),
            new ReferenceInvoicePreSavePlugin(),
        ];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addInvoicePostSavePlugins(Container $container): Container
    {
        $self = $this;

        $container[static::PLUGINS_POST_SAVE] = static function () use ($self) {
            return $self->getInvoicePostSavePlugins();
        };

        return $container;
    }

    /**
     * @return array<\FondOfOryx\Zed\InvoiceExtension\Dependency\Plugin\InvoicePostSavePluginInterface>
     */
    protected function getInvoicePostSavePlugins(): array
    {
        return [
            new ItemsInvoicePostSavePlugin(),
        ];
    }
}
