<?php

namespace FondOfOryx\Zed\PayoneCreditMemo\Communication;

use FondOfOryx\Zed\PayoneCreditMemo\Dependency\Facade\PayoneCreditMemoToCreditMemoInterface;
use FondOfOryx\Zed\PayoneCreditMemo\Dependency\Facade\PayoneCreditMemoToOmsInterface;
use FondOfOryx\Zed\PayoneCreditMemo\Dependency\Facade\PayoneCreditMemoToPayoneInterface;
use FondOfOryx\Zed\PayoneCreditMemo\Dependency\Facade\PayoneCreditMemoToRefundInterface;
use FondOfOryx\Zed\PayoneCreditMemo\Dependency\Facade\PayoneCreditMemoToSalesInterface;
use FondOfOryx\Zed\PayoneCreditMemo\PayoneCreditMemoDependencyProvider;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;

/**
 * @method \FondOfOryx\Zed\PayoneCreditMemo\PayoneCreditMemoConfig getConfig()
 * @method \FondOfOryx\Zed\PayoneCreditMemo\Business\PayoneCreditMemoFacadeInterface getFacade()
 */
class PayoneCreditMemoCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return \FondOfOryx\Zed\PayoneCreditMemo\Dependency\Facade\PayoneCreditMemoToCreditMemoInterface
     */
    public function getCreditMemoFacade(): PayoneCreditMemoToCreditMemoInterface
    {
        return $this->getProvidedDependency(PayoneCreditMemoDependencyProvider::FACADE_CREDIT_MEMO);
    }

    /**
     * @return \FondOfOryx\Zed\PayoneCreditMemo\Dependency\Facade\PayoneCreditMemoToRefundInterface
     */
    public function getRefundFacade(): PayoneCreditMemoToRefundInterface
    {
        return $this->getProvidedDependency(PayoneCreditMemoDependencyProvider::FACADE_REFUND);
    }

    /**
     * @return \FondOfOryx\Zed\PayoneCreditMemo\Dependency\Facade\PayoneCreditMemoToPayoneInterface
     */
    public function getPayoneFacade(): PayoneCreditMemoToPayoneInterface
    {
        return $this->getProvidedDependency(PayoneCreditMemoDependencyProvider::FACADE_PAYONE);
    }

    /**
     * @return \FondOfOryx\Zed\PayoneCreditMemo\Dependency\Facade\PayoneCreditMemoToSalesInterface
     */
    public function getSalesFacade(): PayoneCreditMemoToSalesInterface
    {
        return $this->getProvidedDependency(PayoneCreditMemoDependencyProvider::FACADE_SALES);
    }

    /**
     * @return \FondOfOryx\Zed\PayoneCreditMemo\Dependency\Facade\PayoneCreditMemoToOmsInterface
     */
    public function getOmsFacade(): PayoneCreditMemoToOmsInterface
    {
        return $this->getProvidedDependency(PayoneCreditMemoDependencyProvider::FACADE_OMS);
    }
}
