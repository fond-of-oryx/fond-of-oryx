<?php

namespace FondOfOryx\Zed\OrderBudget;

use FondOfOryx\Zed\OrderBudget\Dependency\Service\OrderBudgetToUtilDateTimeServiceBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class OrderBudgetDependencyProvider extends AbstractBundleDependencyProvider
{
    public const SERVICE_UTIL_DATETIME = 'SERVICE_UTIL_DATETIME';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        return $this->addUtilDatetimeService($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addUtilDatetimeService(Container $container): Container
    {
        $container[static::SERVICE_UTIL_DATETIME] = static function (Container $container) {
            return new OrderBudgetToUtilDateTimeServiceBridge(
                $container->getLocator()->utilDateTime()->service()
            );
        };

        return $container;
    }
}
