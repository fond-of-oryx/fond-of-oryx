<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApi\Business;

use FondOfOryx\Zed\SplittableCheckoutRestApi\Business\Expander\QuoteExpander;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Business\Expander\QuoteExpanderInterface;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Business\Processor\PlaceOrderProcessor;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Business\Processor\PlaceOrderProcessorInterface;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Business\Reader\QuoteReader;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Business\Reader\QuoteReaderInterface;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Business\Reader\SplittableTotalsReader;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Business\Reader\SplittableTotalsReaderInterface;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToQuoteFacadeInterface;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToSplittableCheckoutFacadeInterface;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToSplittableTotalsFacadeInterface;
use FondOfOryx\Zed\SplittableCheckoutRestApi\SplittableCheckoutRestApiDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class SplittableCheckoutRestApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\SplittableCheckoutRestApi\Business\Processor\PlaceOrderProcessorInterface
     */
    public function createPlaceOrderProcessor(): PlaceOrderProcessorInterface
    {
        return new PlaceOrderProcessor(
            $this->createQuoteReader(),
            $this->getSplittableCheckoutFacade(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\SplittableCheckoutRestApi\Business\Reader\SplittableTotalsReaderInterface
     */
    public function createSplittableTotalsReader(): SplittableTotalsReaderInterface
    {
        return new SplittableTotalsReader(
            $this->createQuoteReader(),
            $this->getSplittableTotalsFacade(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\SplittableCheckoutRestApi\Business\Reader\QuoteReaderInterface
     */
    protected function createQuoteReader(): QuoteReaderInterface
    {
        return new QuoteReader(
            $this->createQuoteExpander(),
            $this->getQuoteFacade(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\SplittableCheckoutRestApi\Business\Expander\QuoteExpanderInterface
     */
    protected function createQuoteExpander(): QuoteExpanderInterface
    {
        return new QuoteExpander(
            $this->getQuoteExpanderPlugins(),
        );
    }

    /**
     * @return array<\FondOfOryx\Zed\SplittableCheckoutRestApiExtension\Dependency\Plugin\QuoteExpanderPluginInterface>
     */
    protected function getQuoteExpanderPlugins(): array
    {
        return $this->getProvidedDependency(SplittableCheckoutRestApiDependencyProvider::PLUGINS_QUOTE_EXPANDER);
    }

    /**
     * @return \FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToQuoteFacadeInterface
     */
    protected function getQuoteFacade(): SplittableCheckoutRestApiToQuoteFacadeInterface
    {
        return $this->getProvidedDependency(SplittableCheckoutRestApiDependencyProvider::FACADE_QUOTE);
    }

    /**
     * @return \FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToSplittableCheckoutFacadeInterface
     */
    protected function getSplittableCheckoutFacade(): SplittableCheckoutRestApiToSplittableCheckoutFacadeInterface
    {
        return $this->getProvidedDependency(SplittableCheckoutRestApiDependencyProvider::FACADE_SPLITTABLE_CHECKOUT);
    }

    /**
     * @return \FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToSplittableTotalsFacadeInterface
     */
    protected function getSplittableTotalsFacade(): SplittableCheckoutRestApiToSplittableTotalsFacadeInterface
    {
        return $this->getProvidedDependency(SplittableCheckoutRestApiDependencyProvider::FACADE_SPLITTABLE_TOTALS);
    }
}
