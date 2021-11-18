<?php

namespace FondOfOryx\Zed\SplittableCheckout\Business;

use FondOfOryx\Zed\SplittableCheckout\Business\Workflow\SplittableCheckoutWorkflow;
use FondOfOryx\Zed\SplittableCheckout\Business\Workflow\SplittableCheckoutWorkflowInterface;
use FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToCheckoutFacadeInterface;
use FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToPermissionFacadeInterface;
use FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToQuoteFacadeInterface;
use FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToSplittableQuoteFacadeInterface;
use FondOfOryx\Zed\SplittableCheckout\SplittableCheckoutDependencyProvider;
use FondOfOryx\Zed\SplittableCheckoutExtension\Dependency\Plugin\IdentifierExtractorPluginInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class SplittableCheckoutBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\SplittableCheckout\Business\Workflow\SplittableCheckoutWorkflowInterface
     */
    public function createSplittableCheckoutWorkflow(): SplittableCheckoutWorkflowInterface
    {
        return new SplittableCheckoutWorkflow(
            $this->getCheckoutFacade(),
            $this->getSplittableQuoteFacade(),
            $this->getQuoteFacade(),
            $this->getPermissionFacade(),
            $this->getIdentifierExtractorPlugin(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToCheckoutFacadeInterface
     */
    protected function getCheckoutFacade(): SplittableCheckoutToCheckoutFacadeInterface
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

    /**
     * @return \FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToPermissionFacadeInterface
     */
    protected function getPermissionFacade(): SplittableCheckoutToPermissionFacadeInterface
    {
        return $this->getProvidedDependency(SplittableCheckoutDependencyProvider::FACADE_PERMISSION);
    }

    /**
     * @return \FondOfOryx\Zed\SplittableCheckoutExtension\Dependency\Plugin\IdentifierExtractorPluginInterface|null
     */
    protected function getIdentifierExtractorPlugin(): ?IdentifierExtractorPluginInterface
    {
        return $this->getProvidedDependency(SplittableCheckoutDependencyProvider::PLUGIN_IDENTIFIER_EXTRACTOR);
    }
}
