<?php

namespace FondOfOryx\Zed\NoPaymentCreditMemo;

use FondOfOryx\Zed\NoPaymentCreditMemo\Dependency\Facade\NoPaymentCreditMemoToCreditMemoBridge;
use FondOfOryx\Zed\NoPaymentCreditMemo\Dependency\Facade\NoPaymentCreditMemoToGiftCardProportionalValueBridge;
use FondOfOryx\Zed\NoPaymentCreditMemo\Dependency\Facade\NoPaymentCreditMemoToOmsBridge;
use FondOfOryx\Zed\NoPaymentCreditMemo\Dependency\Facade\NoPaymentCreditMemoToRefundBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class NoPaymentCreditMemoDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_REFUND = 'refund facade';

    /**
     * @var string
     */
    public const FACADE_CREDIT_MEMO = 'FACADE_CREDIT_MEMO';

    /**
     * @var string
     */
    public const FACADE_GIFT_CARD_PROPORTIONAL_VALUE_CONNECTOR = 'FACADE_GIFT_CARD_PROPORTIONAL_VALUE_CONNECTOR';

    /**
     * @var string
     */
    public const FACADE_OMS = 'FACADE_OMS';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container)
    {
        $container = $this->addRefundFacade($container);
        $container = $this->addGiftCardProportionalValueFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container)
    {
        $container = parent::provideCommunicationLayerDependencies($container);
        $container = $this->addCreditMemoFacade($container);
        $container = $this->addRefundFacade($container);
        $container = $this->addOmsFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addRefundFacade(Container $container)
    {
        $container[static::FACADE_REFUND] = function (Container $container) {
            return new NoPaymentCreditMemoToRefundBridge($container->getLocator()->refund()->facade());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCreditMemoFacade(Container $container)
    {
        $container[static::FACADE_CREDIT_MEMO] = function (Container $container) {
            return new NoPaymentCreditMemoToCreditMemoBridge($container->getLocator()->creditMemo()->facade());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addGiftCardProportionalValueFacade(Container $container)
    {
        $container[static::FACADE_GIFT_CARD_PROPORTIONAL_VALUE_CONNECTOR] = function (Container $container) {
            return new NoPaymentCreditMemoToGiftCardProportionalValueBridge($container->getLocator()->giftCardProportionalValue()->facade());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addOmsFacade(Container $container)
    {
        $container[static::FACADE_OMS] = function (Container $container) {
            return new NoPaymentCreditMemoToOmsBridge($container->getLocator()->oms()->facade());
        };

        return $container;
    }
}
