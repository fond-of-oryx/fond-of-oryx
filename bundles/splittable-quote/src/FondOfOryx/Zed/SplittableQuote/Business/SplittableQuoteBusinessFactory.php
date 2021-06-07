<?php

namespace FondOfOryx\Zed\SplittableQuote\Business;

use FondOfOryx\Zed\SplittableQuote\Business\Splitter\QuoteSplitter;
use FondOfOryx\Zed\SplittableQuote\Business\Splitter\QuoteSplitterInterface;
use FondOfOryx\Zed\SplittableQuote\Dependency\Facade\SplittableQuoteToCalculationFacadeInterface;
use FondOfOryx\Zed\SplittableQuote\SplittableQuoteDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\SplittableQuote\SplittableQuoteConfig getConfig()
 */
class SplittableQuoteBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\SplittableQuote\Business\Splitter\QuoteSplitterInterface
     */
    public function createQuoteSplitter(): QuoteSplitterInterface
    {
        return new QuoteSplitter(
            $this->getCalculationFacade(),
            $this->getConfig(),
            $this->getSplittedQuoteExpanderPlugins()
        );
    }

    /**
     * @return \FondOfOryx\Zed\SplittableQuote\Dependency\Facade\SplittableQuoteToCalculationFacadeInterface
     */
    protected function getCalculationFacade(): SplittableQuoteToCalculationFacadeInterface
    {
        return $this->getProvidedDependency(SplittableQuoteDependencyProvider::FACADE_CALCULATION);
    }

    /**
     * @return \FondOfOryx\Zed\SplittableQuoteExtension\Dependency\Plugin\SplittedQuoteExpanderPluginInterface[]
     */
    protected function getSplittedQuoteExpanderPlugins(): array
    {
        return $this->getProvidedDependency(SplittableQuoteDependencyProvider::PLUGINS_SPLITTED_QUOTE_EXPANDER);
    }
}
