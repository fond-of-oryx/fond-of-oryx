<?php

namespace FondOfOryx\Zed\PrepaymentCreditMemo\Communication;

use FondOfOryx\Zed\PrepaymentCreditMemo\Dependency\Facade\PrepaymentCreditMemoToCreditMemoInterface;
use FondOfOryx\Zed\PrepaymentCreditMemo\Dependency\Facade\PrepaymentCreditMemoToOmsInterface;
use FondOfOryx\Zed\PrepaymentCreditMemo\PrepaymentCreditMemoDependencyProvider;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;

/**
 * @method \FondOfOryx\Zed\PrepaymentCreditMemo\PrepaymentCreditMemoConfig getConfig()
 * @method \FondOfOryx\Zed\PrepaymentCreditMemo\Business\PrepaymentCreditMemoFacadeInterface getFacade()
 */
class PrepaymentCreditMemoCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return \FondOfOryx\Zed\PrepaymentCreditMemo\Dependency\Facade\PrepaymentCreditMemoToOmsInterface
     */
    public function getOmsFacade(): PrepaymentCreditMemoToOmsInterface
    {
        return $this->getProvidedDependency(PrepaymentCreditMemoDependencyProvider::FACADE_OMS);
    }

    /**
     * @return \FondOfOryx\Zed\PrepaymentCreditMemo\Dependency\Facade\PrepaymentCreditMemoToCreditMemoInterface
     */
    public function getCreditMemoFacade(): PrepaymentCreditMemoToCreditMemoInterface
    {
        return $this->getProvidedDependency(PrepaymentCreditMemoDependencyProvider::FACADE_CREDIT_MEMO);
    }
}
