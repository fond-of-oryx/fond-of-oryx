<?php

namespace FondOfOryx\Zed\SplittableTotalsRestApi\Business;

use FondOfOryx\Zed\SplittableTotalsRestApi\Business\Expander\QuoteExpander;
use FondOfOryx\Zed\SplittableTotalsRestApi\Business\Expander\QuoteExpanderInterface;
use FondOfOryx\Zed\SplittableTotalsRestApi\Business\Reader\QuoteReader;
use FondOfOryx\Zed\SplittableTotalsRestApi\Business\Reader\QuoteReaderInterface;
use FondOfOryx\Zed\SplittableTotalsRestApi\Business\Reader\SplittableTotalsReader;
use FondOfOryx\Zed\SplittableTotalsRestApi\Business\Reader\SplittableTotalsReaderInterface;
use FondOfOryx\Zed\SplittableTotalsRestApi\Dependency\Facade\SplittableTotalsRestApiToQuoteFacadeInterface;
use FondOfOryx\Zed\SplittableTotalsRestApi\Dependency\Facade\SplittableTotalsRestApiToSplittableTotalsFacadeInterface;
use FondOfOryx\Zed\SplittableTotalsRestApi\SplittableTotalsRestApiDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class SplittableTotalsRestApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\SplittableTotalsRestApi\Business\Reader\SplittableTotalsReaderInterface
     */
    public function createSplittableTotalsReader(): SplittableTotalsReaderInterface
    {
        return new SplittableTotalsReader(
            $this->createQuoteReader(),
            $this->getSplittableTotalsFacade()
        );
    }

    /**
     * @return \FondOfOryx\Zed\SplittableTotalsRestApi\Business\Reader\QuoteReaderInterface
     */
    protected function createQuoteReader(): QuoteReaderInterface
    {
        return new QuoteReader(
            $this->createQuoteExpander(),
            $this->getQuoteFacade()
        );
    }

    /**
     * @return \FondOfOryx\Zed\SplittableTotalsRestApi\Business\Expander\QuoteExpanderInterface
     */
    protected function createQuoteExpander(): QuoteExpanderInterface
    {
        return new QuoteExpander(
            $this->getQuoteExpanderPlugins()
        );
    }

    /**
     * @return \FondOfOryx\Zed\SplittableTotalsRestApiExtension\Dependency\Plugin\QuoteExpanderPluginInterface[]
     */
    protected function getQuoteExpanderPlugins(): array
    {
        return $this->getProvidedDependency(SplittableTotalsRestApiDependencyProvider::PLUGINS_QUOTE_EXPANDER);
    }

    /**
     * @return \FondOfOryx\Zed\SplittableTotalsRestApi\Dependency\Facade\SplittableTotalsRestApiToQuoteFacadeInterface
     */
    protected function getQuoteFacade(): SplittableTotalsRestApiToQuoteFacadeInterface
    {
        return $this->getProvidedDependency(SplittableTotalsRestApiDependencyProvider::FACADE_QUOTE);
    }

    /**
     * @return \FondOfOryx\Zed\SplittableTotalsRestApi\Dependency\Facade\SplittableTotalsRestApiToSplittableTotalsFacadeInterface
     */
    protected function getSplittableTotalsFacade(): SplittableTotalsRestApiToSplittableTotalsFacadeInterface
    {
        return $this->getProvidedDependency(SplittableTotalsRestApiDependencyProvider::FACADE_SPLITTABLE_TOTALS);
    }
}
