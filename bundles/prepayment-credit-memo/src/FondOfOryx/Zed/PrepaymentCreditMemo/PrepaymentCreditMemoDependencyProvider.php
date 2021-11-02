<?php

namespace FondOfOryx\Zed\PrepaymentCreditMemo;

use FondOfOryx\Zed\PrepaymentCreditMemo\Dependency\Facade\PrepaymentCreditMemoToCreditMemoBridge;
use FondOfOryx\Zed\PrepaymentCreditMemo\Dependency\Facade\PrepaymentCreditMemoToOmsBridge;
use FondOfOryx\Zed\PrepaymentCreditMemo\Dependency\Facade\PrepaymentCreditMemoToRefundBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class PrepaymentCreditMemoDependencyProvider extends AbstractBundleDependencyProvider
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
    public const FACADE_OMS = 'FACADE_OMS';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container)
    {
        $container = $this->addRefundFacade($container);
        $container = $this->addCreditMemoFacade($container);

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
        $container[self::FACADE_REFUND] = function (Container $container) {
            return new PrepaymentCreditMemoToRefundBridge($container->getLocator()->refund()->facade());
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
        $container[self::FACADE_CREDIT_MEMO] = function (Container $container) {
            return new PrepaymentCreditMemoToCreditMemoBridge($container->getLocator()->creditMemo()->facade());
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
        $container[self::FACADE_OMS] = function (Container $container) {
            return new PrepaymentCreditMemoToOmsBridge($container->getLocator()->oms()->facade());
        };

        return $container;
    }
}
