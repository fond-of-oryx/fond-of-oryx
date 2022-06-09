<?php

namespace FondOfOryx\Zed\CartSearchRestApi\Business;

use FondOfOryx\Zed\CartSearchRestApi\Business\Reader\QuoteReader;
use FondOfOryx\Zed\CartSearchRestApi\Business\Reader\QuoteReaderInterface;
use FondOfOryx\Zed\CartSearchRestApi\CartSearchRestApiDependencyProvider;
use FondOfOryx\Zed\CartSearchRestApi\Dependency\Facade\CartSearchRestApiToQuoteFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\CartSearchRestApi\Persistence\CartSearchRestApiRepositoryInterface getRepository()
 */
class CartSearchRestApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\CartSearchRestApi\Business\Reader\QuoteReaderInterface
     */
    public function createQuoteReader(): QuoteReaderInterface
    {
        return new QuoteReader(
            $this->getQuoteFacade(),
            $this->getRepository(),
            $this->getSearchQuoteQueryExpanderPlugins(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CartSearchRestApi\Dependency\Facade\CartSearchRestApiToQuoteFacadeInterface
     */
    protected function getQuoteFacade(): CartSearchRestApiToQuoteFacadeInterface
    {
        return $this->getProvidedDependency(CartSearchRestApiDependencyProvider::FACADE_QUOTE);
    }

    /**
     * @return array<\FondOfOryx\Zed\CartSearchRestApiExtension\Dependency\Plugin\SearchQuoteQueryExpanderPluginInterface>
     */
    public function getSearchQuoteQueryExpanderPlugins(): array
    {
        return $this->getProvidedDependency(CartSearchRestApiDependencyProvider::PLUGINS_SEARCH_QUOTE_QUERY_EXPANDER);
    }
}
