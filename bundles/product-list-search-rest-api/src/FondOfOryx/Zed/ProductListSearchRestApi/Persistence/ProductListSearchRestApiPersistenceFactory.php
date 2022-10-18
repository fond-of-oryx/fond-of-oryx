<?php

namespace FondOfOryx\Zed\ProductListSearchRestApi\Persistence;

use FondOfOryx\Zed\ProductListSearchRestApi\Persistence\Propel\Mapper\ProductListMapper;
use FondOfOryx\Zed\ProductListSearchRestApi\Persistence\Propel\Mapper\ProductListMapperInterface;
use FondOfOryx\Zed\ProductListSearchRestApi\Persistence\Propel\QueryBuilder\ProductListSearchFilterFieldQueryBuilder;
use FondOfOryx\Zed\ProductListSearchRestApi\Persistence\Propel\QueryBuilder\ProductListSearchFilterFieldQueryBuilderInterface;
use FondOfOryx\Zed\ProductListSearchRestApi\Persistence\Propel\QueryBuilder\QuoteQueryJoinQueryBuilder;
use FondOfOryx\Zed\ProductListSearchRestApi\Persistence\Propel\QueryBuilder\QuoteQueryJoinQueryBuilderInterface;
use FondOfOryx\Zed\ProductListSearchRestApi\ProductListSearchRestApiDependencyProvider;
use Orm\Zed\ProductList\Persistence\SpyProductListQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfOryx\Zed\ProductListSearchRestApi\ProductListSearchRestApiConfig getConfig()
 */
class ProductListSearchRestApiPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\ProductList\Persistence\SpyProductListQuery
     */
    public function getProductListQuery(): SpyProductListQuery
    {
        return $this->getProvidedDependency(ProductListSearchRestApiDependencyProvider::PROPEL_QUERY_PRODUCT_LIST);
    }

    /**
     * @return \FondOfOryx\Zed\ProductListSearchRestApi\Persistence\Propel\Mapper\ProductListMapperInterface
     */
    public function createProductListMapper(): ProductListMapperInterface
    {
        return new ProductListMapper();
    }

    /**
     * @return \FondOfOryx\Zed\ProductListSearchRestApi\Persistence\Propel\QueryBuilder\ProductListSearchFilterFieldQueryBuilderInterface
     */
    public function createProductListSearchFilterFieldQueryBuilder(): ProductListSearchFilterFieldQueryBuilderInterface
    {
        return new ProductListSearchFilterFieldQueryBuilder($this->getConfig());
    }

    /**
     * @return \FondOfOryx\Zed\ProductListSearchRestApi\Persistence\Propel\QueryBuilder\QuoteQueryJoinQueryBuilderInterface
     */
    public function createQuoteQueryJoinQueryBuilder(): QuoteQueryJoinQueryBuilderInterface
    {
        return new QuoteQueryJoinQueryBuilder();
    }
}
