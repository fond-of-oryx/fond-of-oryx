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

class ConcreteSkuQueryExpanderPlugin extends AbstractPlugin implements QueryExpanderPluginInterface
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
        if (!isset($requestParameters[CatalogSkuFilterConstants::PARAMETER_CONCRETE_SKU])) {
            return $searchQuery;
        }

        $concreteSkus = $requestParameters[CatalogSkuFilterConstants::PARAMETER_CONCRETE_SKU];

        if (!is_array($concreteSkus) || count($concreteSkus) === 0) {
            return $searchQuery;
        }

        $this->getBoolQuery($searchQuery->getSearchQuery())
            ->addMust(new Terms(PageIndexMap::CONCRETE_SKUS, $concreteSkus));

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
                'Concrete sku query expander available only with %s, got: %s',
                BoolQuery::class,
                get_class($boolQuery)
            ));
        }

        return $boolQuery;
    }
}
