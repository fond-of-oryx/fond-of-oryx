<?php

namespace FondOfOryx\Client\CatalogSkuFilter\Plugin\SearchExtension;

use Elastica\Query;
use Elastica\Query\BoolQuery;
use Elastica\Query\Terms;
use FondOfOryx\Shared\CatalogSkuFilter\CatalogSkuFilterConstants;
use Generated\Shared\Search\PageIndexMap;
use InvalidArgumentException;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryExpanderPluginInterface;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

class SkuQueryExpanderPlugin extends AbstractPlugin implements QueryExpanderPluginInterface
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
        if (!isset($requestParameters[CatalogSkuFilterConstants::PARAMETER_SKU])) {
            return $searchQuery;
        }

        $skus = $requestParameters[CatalogSkuFilterConstants::PARAMETER_SKU];

        if (!is_array($skus) || count($skus) === 0) {
            return $searchQuery;
        }

        $this->getBoolQuery($searchQuery->getSearchQuery())
            ->addMust(new Terms(PageIndexMap::SKU, $skus));

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
                'Sku query expander available only with %s, got: %s',
                BoolQuery::class,
                get_class($boolQuery),
            ));
        }

        return $boolQuery;
    }
}
