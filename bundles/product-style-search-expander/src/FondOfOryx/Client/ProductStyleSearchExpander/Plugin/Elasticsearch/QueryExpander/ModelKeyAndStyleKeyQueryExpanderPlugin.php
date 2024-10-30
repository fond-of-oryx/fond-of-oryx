<?php

namespace FondOfOryx\Client\ProductStyleSearchExpander\Plugin\Elasticsearch\QueryExpander;

use Elastica\Query;
use Elastica\Query\BoolQuery;
use FondOfOryx\Shared\ProductStyleSearchExpander\ProductStyleSearchExpanderConstants;
use Generated\Shared\Search\PageIndexMap;
use InvalidArgumentException;
use Spryker\Client\Kernel\AbstractPlugin;
use Spryker\Client\SearchElasticsearch\Config\SortConfig;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryExpanderPluginInterface;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface;

/**
 * @method \FondOfOryx\Client\ProductStyleSearchExpander\ProductStyleSearchExpanderFactory getFactory()
 */
class ModelKeyAndStyleKeyQueryExpanderPlugin extends AbstractPlugin implements QueryExpanderPluginInterface
{
    /**
     * Specification:
     *  - Expands base query.
     *
     * @api
     *
     * @param \Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface $searchQuery
     * @param array $requestParameters
     *
     * @return \Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface
     */
    public function expandQuery(QueryInterface $searchQuery, array $requestParameters = []): QueryInterface
    {
        if (!array_key_exists(ProductStyleSearchExpanderConstants::MODEL_KEY, $requestParameters)) {
            return $searchQuery;
        }

        if (!array_key_exists(ProductStyleSearchExpanderConstants::STYLE_KEY, $requestParameters)) {
            return $searchQuery;
        }

        $modelKey = $requestParameters[ProductStyleSearchExpanderConstants::MODEL_KEY];
        $styleKey = $requestParameters[ProductStyleSearchExpanderConstants::STYLE_KEY];
        $boolQuery = $this->getBoolQuery($searchQuery->getSearchQuery());

        /** @var \Elastica\Query\MatchQuery $matchModelKeyQuery */
        $matchModelKeyQuery = $this->getFactory()
            ->createQueryBuilder()
            ->createMatchQuery();

        $matchModelKeyQuery
            ->setField(ProductStyleSearchExpanderConstants::MODEL_KEY, $modelKey);

        /** @var \Elastica\Query\MatchQuery $matchStyleKeyQuery */
        $matchStyleKeyQuery = $this->getFactory()
            ->createQueryBuilder()
            ->createMatchQuery();

        $matchStyleKeyQuery->setField(ProductStyleSearchExpanderConstants::STYLE_KEY, $styleKey);

        $boolQuery->addMust($matchModelKeyQuery);
        $boolQuery->addMust($matchStyleKeyQuery);

        $this->addSort($searchQuery->getSearchQuery());

        return $searchQuery;
    }

    /**
     * @param \Elastica\Query $searchQuery
     *
     * @return void
     */
    protected function addSort(Query $searchQuery): void
    {
        $searchQuery->addSort([
            PageIndexMap::INTEGER_SORT . '.' . ProductStyleSearchExpanderConstants::STYLE_KEY => [
                'order' => SortConfig::DIRECTION_ASC,
                'mode' => 'min',
            ],
        ]);
    }

    /**
     * @param \Elastica\Query $query
     *
     * @throws \InvalidArgumentException
     *
     * @return \Elastica\Query\BoolQuery
     */
    protected function getBoolQuery(Query $query)
    {
        $boolQuery = $query->getQuery();
        if (!$boolQuery instanceof BoolQuery) {
            throw new InvalidArgumentException(sprintf(
                'Localized query expander available only with %s, got: %s',
                BoolQuery::class,
                get_class($boolQuery),
            ));
        }

        return $boolQuery;
    }
}
