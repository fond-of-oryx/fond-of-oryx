<?php

namespace FondOfOryx\Zed\CreditMemoPayoneDebitConnector;

use FondOfOryx\Zed\CreditMemoPayoneDebitConnector\Dependency\Facade\CreditMemoPayoneDebitConnectorToSalesFacadeBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class CreditMemoPayoneDebitConnectorDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_SALES = 'FACADE_SALES';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addSalesFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addSalesFacade(Container $container): Container
    {
        $container[static::FACADE_SALES] = static function (Container $container) {
            return new CreditMemoPayoneDebitConnectorToSalesFacadeBridge(
                $container->getLocator()->sales()->facade(),
            );
        };

        return $container;
    }
}
