<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderNoPaymentGiftCardConnector;

use FondOfOryx\Zed\JellyfishSalesOrderNoPaymentGiftCardConnector\Dependency\Facade\JellyfishSalesOrderNoPaymentGiftCardConnectorToGiftCardProportionalValueFacadeBridge;
use FondOfOryx\Zed\JellyfishSalesOrderNoPaymentGiftCardConnector\Dependency\Facade\JellyfishSalesOrderNoPaymentGiftCardConnectorToSalesFacadeBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class JellyfishSalesOrderNoPaymentGiftCardConnectorDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_GIFT_CARD_PROPORTIONAL_VALUE = 'FACADE_GIFT_CARD_PROPORTIONAL_VALUE';

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
        $container = $this->addGiftCardProportionalValueFacade($container);
        $container = $this->addSalesFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addGiftCardProportionalValueFacade(Container $container)
    {
        $container[static::FACADE_GIFT_CARD_PROPORTIONAL_VALUE] = static function (Container $container) {
            return new JellyfishSalesOrderNoPaymentGiftCardConnectorToGiftCardProportionalValueFacadeBridge($container->getLocator()->giftCardProportionalValue()->facade());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addSalesFacade(Container $container)
    {
        $container[static::FACADE_SALES] = static function (Container $container) {
            return new JellyfishSalesOrderNoPaymentGiftCardConnectorToSalesFacadeBridge($container->getLocator()->sales()->facade());
        };

        return $container;
    }
}
