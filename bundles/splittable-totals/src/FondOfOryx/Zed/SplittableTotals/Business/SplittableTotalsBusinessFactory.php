<?php

namespace FondOfOryx\Zed\SplittableTotals\Business;

use FondOfOryx\Zed\SplittableTotals\Business\Reader\SplittableTotalsReader;
use FondOfOryx\Zed\SplittableTotals\Business\Reader\SplittableTotalsReaderInterface;
use FondOfOryx\Zed\SplittableTotals\Business\Splitter\QuoteSplitter;
use FondOfOryx\Zed\SplittableTotals\Business\Splitter\QuoteSplitterInterface;
use FondOfOryx\Zed\SplittableTotals\Dependency\Facade\SplittableTotalsToCalculationFacadeInterface;
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
            $this->createQuoteSplitter(),
            $this->getCalculationFacade(),
            $this->getSplittedQuoteExpanderPlugins()
        );
    }

    /**
     * @return \FondOfOryx\Zed\SplittableTotals\Business\Splitter\QuoteSplitterInterface
     */
    protected function createQuoteSplitter(): QuoteSplitterInterface
    {
        return new QuoteSplitter(
            $this->getCalculationFacade(),
            $this->getConfig()
        );
    }

    /**
     * @return \FondOfOryx\Zed\SplittableTotals\Dependency\Facade\SplittableTotalsToCalculationFacadeInterface
     */
    protected function getCalculationFacade(): SplittableTotalsToCalculationFacadeInterface
    {
        return $this->getProvidedDependency(SplittableTotalsDependencyProvider::FACADE_CALCULATION);
    }

    /**
     * @return \FondOfOryx\Zed\SplittableTotalsExtension\Dependency\Plugin\SplittedQuoteExpanderPluginInterface[]
     */
    protected function getSplittedQuoteExpanderPlugins(): array
    {
        return $this->getProvidedDependency(SplittableTotalsDependencyProvider::PLUGINS_SPLITTED_QUOTE_EXPANDER);
    }
}
