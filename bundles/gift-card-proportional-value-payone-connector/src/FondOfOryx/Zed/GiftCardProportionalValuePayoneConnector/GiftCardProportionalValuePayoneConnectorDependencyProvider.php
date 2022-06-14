<?php

namespace FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector;

use FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\Dependency\Facade\GiftCardProportionalValuePayoneConnectorToSalesFacadeBridge;
use FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\Dependency\Service\GiftCardProportionalValuePayoneConnectorToPayoneService;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

/**
 * @method \Spryker\Zed\Sales\SalesConfig getConfig()
 */
class GiftCardProportionalValuePayoneConnectorDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const SERVICE_PAYONE = 'SERVICE_PAYONE';

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
        $container = $this->addPayoneService($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addSalesFacade(Container $container)
    {
        $container[static::FACADE_SALES] = function (Container $container) {
            return new GiftCardProportionalValuePayoneConnectorToSalesFacadeBridge($container->getLocator()->sales()->facade());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addPayoneService(Container $container)
    {
        $container[static::SERVICE_PAYONE] = function (Container $container) {
            return new GiftCardProportionalValuePayoneConnectorToPayoneService($container->getLocator()->payone()->service());
        };

        return $container;
    }
}
