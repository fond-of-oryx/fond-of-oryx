<?php

namespace FondOfOryx\Zed\NoPaymentCreditMemo\Communication;

use FondOfOryx\Zed\NoPaymentCreditMemo\Dependency\Facade\NoPaymentCreditMemoToCreditMemoInterface;
use FondOfOryx\Zed\NoPaymentCreditMemo\Dependency\Facade\NoPaymentCreditMemoToOmsInterface;
use FondOfOryx\Zed\NoPaymentCreditMemo\NoPaymentCreditMemoDependencyProvider;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;

/**
 * @method \FondOfOryx\Zed\NoPaymentCreditMemo\NoPaymentCreditMemoConfig getConfig()
 * @method \FondOfOryx\Zed\NoPaymentCreditMemo\Business\NoPaymentCreditMemoFacadeInterface getFacade()
 */
class NoPaymentCreditMemoCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return \FondOfOryx\Zed\NoPaymentCreditMemo\Dependency\Facade\NoPaymentCreditMemoToOmsInterface
     */
    public function getOmsFacade(): NoPaymentCreditMemoToOmsInterface
    {
        return $this->getProvidedDependency(NoPaymentCreditMemoDependencyProvider::FACADE_OMS);
    }

    /**
     * @return \FondOfOryx\Zed\NoPaymentCreditMemo\Dependency\Facade\NoPaymentCreditMemoToCreditMemoInterface
     */
    public function getCreditMemoFacade(): NoPaymentCreditMemoToCreditMemoInterface
    {
        return $this->getProvidedDependency(NoPaymentCreditMemoDependencyProvider::FACADE_CREDIT_MEMO);
    }
}
