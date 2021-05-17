<?php

namespace FondOfOryx\Client\CatalogSkuFilter\Plugin\SearchExtension;

use Elastica\Query;
use Elastica\Query\BoolQuery;
use Elastica\Query\Wildcard;
use FondOfOryx\Shared\CatalogSkuFilter\CatalogSkuFilterConstants;
use Generated\Shared\Search\PageIndexMap;
use InvalidArgumentException;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryExpanderPluginInterface;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

class SkuPatternQueryExpanderPlugin extends AbstractPlugin implements QueryExpanderPluginInterface
{
    /**
     * @param \Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface $searchQuery
     * @param array $requestParameters
     *
     * @return \Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface
     */
    public function expandQuery(
        QueryInterface $searchQuery,
        array $requestParameters = []
    ): QueryInterface {
        if (!isset($requestParameters[CatalogSkuFilterConstants::PARAMETER_SKU_PATTERN])) {
            return $searchQuery;
        }

        $skuPattern = $requestParameters[CatalogSkuFilterConstants::PARAMETER_SKU_PATTERN];

        if (!is_string($skuPattern) || $skuPattern === '') {
            return $searchQuery;
        }

        $this->getBoolQuery($searchQuery->getSearchQuery())
            ->addMust(new Wildcard(PageIndexMap::SKU, $skuPattern));

        return $searchQuery;
    }

    /**
     * @param \Elastica\Query $query
     *
     * @throws \InvalidArgumentException
     *
     * @return \Elastica\Query\BoolQuery
     */
    protected function getBoolQuery(Query $query): BoolQuery
    {
        $boolQuery = $query->getQuery();

        if (!$boolQuery instanceof BoolQuery) {
            throw new InvalidArgumentException(sprintf(
                'Sku pattern query expander available only with %s, got: %s',
                BoolQuery::class,
                get_class($boolQuery)
            ));
        }

        return $boolQuery;
    }
}
