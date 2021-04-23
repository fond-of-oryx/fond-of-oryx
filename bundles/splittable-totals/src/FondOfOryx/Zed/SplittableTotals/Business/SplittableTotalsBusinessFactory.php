<?php

namespace FondOfOryx\Zed\SplittableTotals\Business;

use FondOfOryx\Zed\SplittableTotals\Business\Reader\QuoteReader;
use FondOfOryx\Zed\SplittableTotals\Business\Reader\QuoteReaderInterface;
use FondOfOryx\Zed\SplittableTotals\Business\Reader\SplittableTotalsReader;
use FondOfOryx\Zed\SplittableTotals\Business\Reader\SplittableTotalsReaderInterface;
use FondOfOryx\Zed\SplittableTotals\Business\Splitter\QuoteSplitter;
use FondOfOryx\Zed\SplittableTotals\Business\Splitter\QuoteSplitterInterface;
use FondOfOryx\Zed\SplittableTotals\Dependency\Facade\SplittableTotalsToCalculationFacadeInterface;
use FondOfOryx\Zed\SplittableTotals\Dependency\Facade\SplittableTotalsToQuoteFacadeInterface;
use FondOfOryx\Zed\SplittableTotals\SplittableTotalsDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\SplittableTotals\SplittableTotalsConfig getConfig()
 */
class SplittableTotalsBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\SplittableTotals\Business\Reader\SplittableTotalsReaderInterface
     */
    public function createSplittableTotalsReader(): SplittableTotalsReaderInterface
    {
        return new SplittableTotalsReader(
            $this->createQuoteReader(),
            $this->createQuoteSplitter(),
            $this->getCalculationFacade()
        );
    }

    /**
     * @return \FondOfOryx\Zed\SplittableTotals\Business\Reader\QuoteReaderInterface
     */
    protected function createQuoteReader(): QuoteReaderInterface
    {
        return new QuoteReader(
            $this->getQuoteFacade(),
            $this->getQuoteExpanderPlugins()
        );
    }

    /**
     * @return \FondOfOryx\Zed\SplittableTotals\Dependency\Facade\SplittableTotalsToQuoteFacadeInterface
     */
    protected function getQuoteFacade(): SplittableTotalsToQuoteFacadeInterface
    {
        return $this->getProvidedDependency(SplittableTotalsDependencyProvider::FACADE_QUOTE);
    }

    /**
     * @return \FondOfOryx\Zed\SplittableTotalsExtension\Dependency\Plugin\QuoteExpanderPluginInterface[]
     */
    protected function getQuoteExpanderPlugins(): array
    {
        return $this->getProvidedDependency(SplittableTotalsDependencyProvider::PLUGINS_QUOTE_EXPANDER);
    }

    /**
     * @return \FondOfOryx\Zed\SplittableTotals\Business\Splitter\QuoteSplitterInterface
     */
    protected function createQuoteSplitter(): QuoteSplitterInterface
    {
        return new QuoteSplitter($this->getConfig());
    }

    /**
     * @return \FondOfOryx\Zed\SplittableTotals\Dependency\Facade\SplittableTotalsToCalculationFacadeInterface
     */
    protected function getCalculationFacade(): SplittableTotalsToCalculationFacadeInterface
    {
        return $this->getProvidedDependency(SplittableTotalsDependencyProvider::FACADE_CALCULATION);
    }
}
