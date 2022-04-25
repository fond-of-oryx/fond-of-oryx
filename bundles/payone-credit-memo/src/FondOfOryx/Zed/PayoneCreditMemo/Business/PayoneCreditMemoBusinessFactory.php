<?php

namespace FondOfOryx\Zed\PayoneCreditMemo\Business;

use FondOfOryx\Zed\PayoneCreditMemo\Business\Refund\PartialRefund;
use FondOfOryx\Zed\PayoneCreditMemo\Business\Refund\PartialRefundInterface;
use FondOfOryx\Zed\PayoneCreditMemo\Dependency\Facade\PayoneCreditMemoToCreditMemoInterface;
use FondOfOryx\Zed\PayoneCreditMemo\Dependency\Facade\PayoneCreditMemoToPayoneInterface;
use FondOfOryx\Zed\PayoneCreditMemo\Dependency\Facade\PayoneCreditMemoToRefundInterface;
use FondOfOryx\Zed\PayoneCreditMemo\Dependency\Facade\PayoneCreditMemoToSalesInterface;
use FondOfOryx\Zed\PayoneCreditMemo\PayoneCreditMemoDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\PayoneCreditMemo\PayoneCreditMemoConfig getConfig()
 */
class PayoneCreditMemoBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\PayoneCreditMemo\Business\Refund\PartialRefundInterface
     */
    public function createPartialRefund(): PartialRefundInterface
    {
        return new PartialRefund(
            $this->getCreditMemoFacade(),
            $this->getRefundFacade(),
            $this->getSalesFacade(),
            $this->getPayoneFacadeFacade(),
            $this->getPreRefundPlugins(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\PayoneCreditMemo\Dependency\Facade\PayoneCreditMemoToCreditMemoInterface
     */
    protected function getCreditMemoFacade(): PayoneCreditMemoToCreditMemoInterface
    {
        return $this->getProvidedDependency(PayoneCreditMemoDependencyProvider::FACADE_CREDIT_MEMO);
    }

    /**
     * @return \FondOfOryx\Zed\PayoneCreditMemo\Dependency\Facade\PayoneCreditMemoToRefundInterface
     */
    protected function getRefundFacade(): PayoneCreditMemoToRefundInterface
    {
        return $this->getProvidedDependency(PayoneCreditMemoDependencyProvider::FACADE_REFUND);
    }

    /**
     * @return \FondOfOryx\Zed\PayoneCreditMemo\Dependency\Facade\PayoneCreditMemoToSalesInterface
     */
    protected function getSalesFacade(): PayoneCreditMemoToSalesInterface
    {
        return $this->getProvidedDependency(PayoneCreditMemoDependencyProvider::FACADE_SALES);
    }

    /**
     * @return \FondOfOryx\Zed\PayoneCreditMemo\Dependency\Facade\PayoneCreditMemoToPayoneInterface
     */
    protected function getPayoneFacadeFacade(): PayoneCreditMemoToPayoneInterface
    {
        return $this->getProvidedDependency(PayoneCreditMemoDependencyProvider::FACADE_PAYONE);
    }

    /**
     * @return array<\FondOfOryx\Zed\PayoneCreditMemoExtension\Dependency\Plugin\PayoneCreditMemoPreRefundPluginInterface>
     */
    protected function getPreRefundPlugins(): array
    {
        return $this->getProvidedDependency(PayoneCreditMemoDependencyProvider::PLUGINS_PRE_REFUND);
    }
}
