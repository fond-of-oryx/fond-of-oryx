<?php

namespace FondOfOryx\Zed\CustomerStatistic;

use FondOfOryx\Zed\CustomerStatistic\Dependency\QueryContainer\CustomerStatisticToCustomerQueryContainerBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class CustomerStatisticDependencyProvider extends AbstractBundleDependencyProvider
{
    public const QUERY_CONTAINER_CUSTOMER = 'QUERY_CONTAINER_CUSTOMER';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container): Container
    {
        $container = parent::providePersistenceLayerDependencies($container);

        $container = $this->addCustomerQueryContainer($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCustomerQueryContainer(Container $container): Container
    {
        $container[static::QUERY_CONTAINER_CUSTOMER] = static function (Container $container) {
            return new CustomerStatisticToCustomerQueryContainerBridge(
                $container->getLocator()->customer()->queryContainer()
            );
        };

        return $container;
    }
}
