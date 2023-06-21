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
            $this->getSearchProductListQueryExpanderPlugins(),
        );
    }

    /**
     * @return array<\FondOfOryx\Zed\ProductListSearchRestApiExtension\Dependency\Plugin\SearchProductListQueryExpanderPluginInterface>
     */
    public function getSearchProductListQueryExpanderPlugins(): array
    {
        return $this->getProvidedDependency(ProductListSearchRestApiDependencyProvider::PLUGINS_SEARCH_PRODUCT_LIST_QUERY_EXPANDER);
    }
}
