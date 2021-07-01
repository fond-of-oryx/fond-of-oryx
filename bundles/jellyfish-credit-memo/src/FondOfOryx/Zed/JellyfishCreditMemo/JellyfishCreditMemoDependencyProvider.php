<?php

namespace FondOfOryx\Zed\JellyfishCreditMemo;

use FondOfOryx\Zed\JellyfishCreditMemo\Dependency\Facade\JellyfishCreditMemoToSalesFacadeBridge;
use FondOfOryx\Zed\JellyfishCreditMemo\Dependency\Service\JellyfishCreditMemoToUtilEncodingServiceBridge;
use Orm\Zed\Sales\Persistence\SpySalesOrderItemQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class JellyfishCreditMemoDependencyProvider extends AbstractBundleDependencyProvider
{
    public const FACADE_SALES = 'FACADE_SALES';
    public const PROPEL_QUERY_SALES_ORDER_ITEM = 'PROPEL_QUERY_SALES_ORDER_ITEM';
    public const SERVICE_UTIL_ENCODING = 'SERVICE_UTIL_ENCODING';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);
        $container = $this->addSalesFacade($container);
        $container = $this->addUtilEncodingService($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container): Container
    {
        $container = parent::providePersistenceLayerDependencies($container);
        $container = $this->addSalesOrderItemPropelQuery($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addSalesOrderItemPropelQuery(Container $container): Container
    {
        $container[static::PROPEL_QUERY_SALES_ORDER_ITEM] = function (Container $container) {
            return SpySalesOrderItemQuery::create();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addSalesFacade(Container $container): Container
    {
        $container[static::FACADE_SALES] = function (Container $container) {
            return new JellyfishCreditMemoToSalesFacadeBridge(
                $container->getLocator()->sales()->facade()
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
        $container[static::SERVICE_UTIL_ENCODING] = function (Container $container) {
            return new JellyfishCreditMemoToUtilEncodingServiceBridge(
                $container->getLocator()->utilEncoding()->service()
            );
        };

        return $container;
    }
}
