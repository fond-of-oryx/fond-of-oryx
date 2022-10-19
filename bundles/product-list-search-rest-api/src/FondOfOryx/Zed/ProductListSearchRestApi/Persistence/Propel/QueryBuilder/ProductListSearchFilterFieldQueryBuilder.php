<?php

namespace FondOfOryx\Zed\ProductListSearchRestApi\Persistence\Propel\QueryBuilder;

use FondOfOryx\Zed\ProductListSearchRestApi\ProductListSearchRestApiConfig;
use Generated\Shared\Transfer\FilterFieldTransfer;
use Generated\Shared\Transfer\ProductListCollectionTransfer;
use Orm\Zed\ProductList\Persistence\SpyProductListQuery;
use Propel\Runtime\ActiveQuery\Criteria;

/**
 * @codeCoverageIgnore
 */
class ProductListSearchFilterFieldQueryBuilder implements ProductListSearchFilterFieldQueryBuilderInterface
{
    /**
     * @var \FondOfOryx\Zed\ProductListSearchRestApi\ProductListSearchRestApiConfig
     */
    protected $config;

    /**
     * @param \FondOfOryx\Zed\ProductListSearchRestApi\ProductListSearchRestApiConfig $config
     */
    public function __construct(ProductListSearchRestApiConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @param \Orm\Zed\ProductList\Persistence\SpyProductListQuery $query
     * @param \Generated\Shared\Transfer\ProductListCollectionTransfer $productListCollectionTransfer
     *
     * @return \Orm\Zed\ProductList\Persistence\SpyProductListQuery
     */
    public function addQueryFilters(
        SpyProductListQuery $query,
        ProductListCollectionTransfer $productListCollectionTransfer
    ): SpyProductListQuery {
        foreach ($productListCollectionTransfer->getFilterFields() as $filterFieldTransfer) {
            $query = $this->addQueryFilter($query, $filterFieldTransfer);
        }

        return $query;
    }

    /**
     * @param \Orm\Zed\ProductList\Persistence\SpyProductListQuery $productListQuery
     * @param \Generated\Shared\Transfer\FilterFieldTransfer $filterFieldTransfer
     *
     * @return \Orm\Zed\ProductList\Persistence\SpyProductListQuery
     */
    protected function addQueryFilter(
        SpyProductListQuery $productListQuery,
        FilterFieldTransfer $filterFieldTransfer
    ): SpyProductListQuery {
        if (
            !$this->config->getFilterFieldTypeMapping()
            || !in_array($filterFieldTransfer->getType(), $this->config->getFilterFieldTypeMapping())
        ) {
            return $productListQuery;
        }

        return $productListQuery->add(
            $this->config->getFilterFieldTypeMapping()[$filterFieldTransfer->getType()],
            $filterFieldTransfer->getValue(),
            Criteria::EQUAL,
        );
    }
}
