<?php

namespace FondOfOryx\Zed\ProductListSearchRestApi\Business;

use FondOfOryx\Zed\ProductListSearchRestApi\Business\Reader\ProductListReader;
use FondOfOryx\Zed\ProductListSearchRestApi\Business\Reader\ProductListReaderInterface;
use FondOfOryx\Zed\ProductListSearchRestApi\ProductListSearchRestApiDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\ProductListSearchRestApi\Persistence\ProductListSearchRestApiRepositoryInterface getRepository()
 */
class ProductListSearchRestApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\ProductListSearchRestApi\Business\Reader\ProductListReaderInterface
     */
    public function createProductListReader(): ProductListReaderInterface
    {
        return new ProductListReader(
            $this->getRepository(),
            $this->getSearchQuoteQueryExpanderPlugins(),
        );
    }

    /**
     * @return array<\FondOfOryx\Zed\ProductListSearchRestApiExtension\Dependency\Plugin\SearchQuoteQueryExpanderPluginInterface>
     */
    public function getSearchQuoteQueryExpanderPlugins(): array
    {
        return $this->getProvidedDependency(ProductListSearchRestApiDependencyProvider::PLUGINS_SEARCH_QUOTE_QUERY_EXPANDER);
    }
}
