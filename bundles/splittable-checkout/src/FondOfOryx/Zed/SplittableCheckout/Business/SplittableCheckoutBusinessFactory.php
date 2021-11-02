<?php

namespace FondOfOryx\Zed\SplittableCheckout\Business;

use FondOfOryx\Zed\SplittableCheckout\Business\Workflow\SplittableCheckoutWorkflow;
use FondOfOryx\Zed\SplittableCheckout\Business\Workflow\SplittableCheckoutWorkflowInterface;
use FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToCheckoutFacadeInterface;
use FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToQuoteFacadeInterface;
use FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToSplittableQuoteFacadeInterface;
use FondOfOryx\Zed\SplittableCheckout\SplittableCheckoutDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class SplittableCheckoutBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\SplittableCheckout\Business\Workflow\SplittableCheckoutWorkflowInterface
     */
    public function createSplittableCheckoutWorkflow(): SplittableCheckoutWorkflowInterface
    {
        return new SplittableCheckoutWorkflow(
            $this->getSplittableCheckoutFacade(),
            $this->getSplittableQuoteFacade(),
            $this->getQuoteFacade(),
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
     * @return \FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToSplittableQuoteFacadeInterface
     */
    protected function getSplittableQuoteFacade(): SplittableCheckoutToSplittableQuoteFacadeInterface
    {
        return $this->getProvidedDependency(SplittableCheckoutDependencyProvider::FACADE_SPLITTABLE_QUOTE);
    }

    /**
     * @return \FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToQuoteFacadeInterface
     */
    protected function getQuoteFacade(): SplittableCheckoutToQuoteFacadeInterface
    {
        return $this->getProvidedDependency(SplittableCheckoutDependencyProvider::FACADE_QUOTE);
    }
}
