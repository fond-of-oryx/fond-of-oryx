<?php

namespace FondOfOryx\Zed\NoPaymentCreditMemo\Business;

use FondOfOryx\Zed\NoPaymentCreditMemo\Business\Model\Payment\Refund;
use FondOfOryx\Zed\NoPaymentCreditMemo\Dependency\Facade\NoPaymentCreditMemoToGiftCardProportionalValueInterface;
use FondOfOryx\Zed\NoPaymentCreditMemo\Dependency\Facade\NoPaymentCreditMemoToRefundInterface;
use FondOfOryx\Zed\NoPaymentCreditMemo\NoPaymentCreditMemoDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\NoPaymentCreditMemo\NoPaymentCreditMemoConfig getConfig()
 */
class NoPaymentCreditMemoBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\NoPaymentCreditMemo\Business\Model\Payment\RefundInterface
     */
    public function createRefund()
    {
        return new Refund(
            $this->getRefundFacade(),
            $this->getGiftCardProportionalValueFacade(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\NoPaymentCreditMemo\Dependency\Facade\NoPaymentCreditMemoToRefundInterface
     */
    protected function getRefundFacade(): NoPaymentCreditMemoToRefundInterface
    {
        return $this->getProvidedDependency(NoPaymentCreditMemoDependencyProvider::FACADE_REFUND);
    }

    /**
     * @return \FondOfOryx\Zed\NoPaymentCreditMemo\Dependency\Facade\NoPaymentCreditMemoToGiftCardProportionalValueInterface
     */
    protected function getGiftCardProportionalValueFacade(): NoPaymentCreditMemoToGiftCardProportionalValueInterface
    {
        return $this->getProvidedDependency(NoPaymentCreditMemoDependencyProvider::FACADE_GIFT_CARD_PROPORTIONAL_VALUE_CONNECTOR);
    }
}
