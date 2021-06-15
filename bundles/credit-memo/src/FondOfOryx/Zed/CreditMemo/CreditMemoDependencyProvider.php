<?php

namespace FondOfOryx\Zed\CreditMemo;

use FondOfOryx\Zed\CreditMemo\Communication\Plugin\CreditMemoExtension\ItemsCreditMemoPostSavePlugin;
use FondOfOryx\Zed\CreditMemo\Communication\Plugin\CreditMemoExtension\LocaleResolverCreditMemoPreSavePlugin;
use FondOfOryx\Zed\CreditMemo\Communication\Plugin\CreditMemoExtension\ReferenceCreditMemoPreSavePlugin;
use FondOfOryx\Zed\CreditMemo\Communication\Plugin\CreditMemoExtension\SalesPaymentMethodTypeCreditMemoPreSavePlugin;
use FondOfOryx\Zed\CreditMemo\Dependency\Facade\CreditMemoToLocaleFacadeBridge;
use FondOfOryx\Zed\CreditMemo\Dependency\Facade\CreditMemoToSequenceNumberFacadeBridge;
use FondOfOryx\Zed\CreditMemo\Dependency\Facade\CreditMemoToStoreFacadeBridge;
use Orm\Zed\Payment\Persistence\SpySalesPaymentQuery;
use Orm\Zed\Sales\Persistence\SpySalesOrderItemQuery;
use Orm\Zed\Sales\Persistence\SpySalesOrderQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

/**
 * @method \FondOfOryx\Zed\CreditMemo\CreditMemoConfig getConfig()
 */
class CreditMemoDependencyProvider extends AbstractBundleDependencyProvider
{
    public const FACADE_SEQUENCE_NUMBER = 'FACADE_SEQUENCE_NUMBER';
    public const FACADE_STORE = 'FACADE_STORE';
    public const FACADE_LOCALE = 'FACADE_LOCALE';

    public const PLUGINS_POST_SAVE = 'PLUGINS_POST_SAVE';
    public const PLUGINS_PRE_SAVE = 'PLUGINS_PRE_SAVE';
    public const PLUGINS_PROCESSOR = 'PLUGINS_PROCESSOR';
    public const QUERY_SALES_PAYMENT = 'QUERY_SALES_PAYMENT';
    public const QUERY_SALES_ORDER = 'QUERY_SALES_ORDER';
    public const QUERY_SALES_ORDER_ITEM = 'QUERY_SALES_ORDER_ITEM';

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
        $container = $this->addLocaleFacade($container);

        $container = $this->addCreditMemoPreSavePlugins($container);
        $container = $this->addCreditMemoPostSavePlugins($container);
        $container = $this->addCreditMemoProcessorPlugins($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container)
    {
        $container = $this->addSpySalesPaymentQuery($container);
        $container = $this->addSpySalesOrderQuery($container);
        $container = $this->addSpySalesOrderItemQuery($container);

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
            return new CreditMemoToSequenceNumberFacadeBridge(
                $container->getLocator()->sequenceNumber()->facade()
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
            return new CreditMemoToStoreFacadeBridge(
                $container->getLocator()->store()->facade()
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addLocaleFacade(Container $container): Container
    {
        $container[static::FACADE_LOCALE] = static function (Container $container) {
            return new CreditMemoToLocaleFacadeBridge(
                $container->getLocator()->locale()->facade()
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCreditMemoPreSavePlugins(Container $container): Container
    {
        $self = $this;

        $container[static::PLUGINS_PRE_SAVE] = static function () use ($self) {
            return $self->getCreditMemoPreSavePlugins();
        };

        return $container;
    }

    /**
     * @return \FondOfOryx\Zed\CreditMemoExtension\Dependency\Plugin\CreditMemoPreSavePluginInterface[]
     */
    protected function getCreditMemoPreSavePlugins(): array
    {
        return [
            new ReferenceCreditMemoPreSavePlugin(),
            new SalesPaymentMethodTypeCreditMemoPreSavePlugin(),
            new LocaleResolverCreditMemoPreSavePlugin(),
        ];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCreditMemoPostSavePlugins(Container $container): Container
    {
        $self = $this;

        $container[static::PLUGINS_POST_SAVE] = static function () use ($self) {
            return $self->getCreditMemoPostSavePlugins();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCreditMemoProcessorPlugins(Container $container): Container
    {
        $self = $this;

        $container[static::PLUGINS_PROCESSOR] = static function () use ($self) {
            return $self->getCreditMemoProcessorPlugins();
        };

        return $container;
    }

    /**
     * @return \FondOfOryx\Zed\CreditMemoExtension\Dependency\Plugin\CreditMemoPostSavePluginInterface[]
     */
    protected function getCreditMemoPostSavePlugins(): array
    {
        return [
            new ItemsCreditMemoPostSavePlugin(),
        ];
    }

    /**
     * @return \FondOfOryx\Zed\CreditMemoExtension\Dependency\Plugin\CreditMemoProcessorPluginInterface[]
     */
    protected function getCreditMemoProcessorPlugins(): array
    {
        return [];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addSpySalesPaymentQuery(Container $container): Container
    {
        $container[static::QUERY_SALES_PAYMENT] = static function () {
            return SpySalesPaymentQuery::create();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addSpySalesOrderQuery(Container $container): Container
    {
        $container[static::QUERY_SALES_ORDER] = static function () {
            return SpySalesOrderQuery::create();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addSpySalesOrderItemQuery(Container $container): Container
    {
        $container[static::QUERY_SALES_ORDER_ITEM] = static function () {
            return SpySalesOrderItemQuery::create();
        };

        return $container;
    }
}
