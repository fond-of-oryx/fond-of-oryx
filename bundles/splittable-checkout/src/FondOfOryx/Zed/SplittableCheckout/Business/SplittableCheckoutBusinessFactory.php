<?php

namespace FondOfOryx\Zed\SplittableCheckout\Business;

use FondOfOryx\Zed\SplittableCheckout\Business\Model\QuoteSplitter;
use FondOfOryx\Zed\SplittableCheckout\Business\Model\QuoteSplitterInterface;
use FondOfOryx\Zed\SplittableCheckout\Business\Workflow\SplittableCheckoutWorkflow;
use FondOfOryx\Zed\SplittableCheckout\Business\Workflow\SplittableCheckoutWorkflowInterface;
use FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToCheckoutFacadeInterface;
use FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToPersistentCartFacadeInterface;
use FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToQuoteFacadeInterface;
use FondOfOryx\Zed\SplittableCheckout\SplittableCheckoutDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\SplittableCheckout\SplittableCheckoutConfig getConfig()
 */
class SplittableCheckoutBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\SplittableCheckout\Business\Workflow\SplittableCheckoutWorkflowInterface
     */
    public function createSplittableCheckoutWorkflow(): SplittableCheckoutWorkflowInterface
    {
        return new SplittableCheckoutWorkflow(
            $this->getSplittableCheckoutFacade(),
            $this->getQuoteFacade(),
            $this->createQuoteSplitter()
        );
    }

    /**
     * @return \FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToCheckoutFacadeInterface
     */
    protected function getSplittableCheckoutFacade(): SplittableCheckoutToCheckoutFacadeInterface
    {
        return $this->getProvidedDependency(SplittableCheckoutDependencyProvider::FACADE_CHECKOUT);
    }

    /**
     * @return \FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToPersistentCartFacadeInterface
     */
    protected function getPersistentCartFacade(): SplittableCheckoutToPersistentCartFacadeInterface
    {
        return $this->getProvidedDependency(SplittableCheckoutDependencyProvider::FACADE_PERSISTENT_CART);
    }

    /**
     * @return \FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToQuoteFacadeInterface
     */
    protected function getQuoteFacade(): SplittableCheckoutToQuoteFacadeInterface
    {
        return $this->getProvidedDependency(SplittableCheckoutDependencyProvider::FACADE_QUOTE);
    }

    /**
     * @return \FondOfOryx\Zed\SplittableCheckout\Business\Model\QuoteSplitterInterface
     */
    protected function createQuoteSplitter(): QuoteSplitterInterface
    {
        return new QuoteSplitter(
            $this->getPersistentCartFacade(),
            $this->getConfig()
        );
    }
}
