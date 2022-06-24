<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector;

use FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\Dependency\Facade\JellyfishSalesOrderGiftCardProportionalValueConnectorToGiftCardProportionalValueFacadeBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class JellyfishSalesOrderGiftCardProportionalValueConnectorDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_GIFT_CARD_PROPORTIONAL_VALUE = 'FACADE_GIFT_CARD_PROPORTIONAL_VALUE';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);
        $container = $this->addGiftCardProportionalValueFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addGiftCardProportionalValueFacade(Container $container)
    {
        $container[static::FACADE_GIFT_CARD_PROPORTIONAL_VALUE] = function (Container $container) {
            return new JellyfishSalesOrderGiftCardProportionalValueConnectorToGiftCardProportionalValueFacadeBridge($container->getLocator()->giftCardProportionalValue()->facade());
        };

        return $container;
    }
}
