<?php

namespace FondOfOryx\Zed\PrepaymentCreditMemo\Business;

use FondOfOryx\Zed\PrepaymentCreditMemo\Business\Model\Payment\Refund;
use FondOfOryx\Zed\PrepaymentCreditMemo\Dependency\Facade\PrepaymentCreditMemoToCreditMemoInterface;
use FondOfOryx\Zed\PrepaymentCreditMemo\PrepaymentCreditMemoDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\PrepaymentCreditMemo\PrepaymentCreditMemoConfig getConfig()
 */
class PrepaymentCreditMemoBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\PrepaymentCreditMemo\Business\Model\Payment\RefundInterface
     */
    public function createRefund()
    {
        return new Refund(
            $this->getRefundFacade(),
            $this->getCreditMemoFacade(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\PrepaymentCreditMemo\Dependency\Facade\PrepaymentCreditMemoToRefundInterface
     */
    protected function getRefundFacade()
    {
        return $this->getProvidedDependency(PrepaymentCreditMemoDependencyProvider::FACADE_REFUND);
    }

    /**
     * @return \FondOfOryx\Zed\PrepaymentCreditMemo\Dependency\Facade\PrepaymentCreditMemoToCreditMemoInterface
     */
    public function getCreditMemoFacade(): PrepaymentCreditMemoToCreditMemoInterface
    {
        return $this->getProvidedDependency(PrepaymentCreditMemoDependencyProvider::FACADE_CREDIT_MEMO);
    }
}
