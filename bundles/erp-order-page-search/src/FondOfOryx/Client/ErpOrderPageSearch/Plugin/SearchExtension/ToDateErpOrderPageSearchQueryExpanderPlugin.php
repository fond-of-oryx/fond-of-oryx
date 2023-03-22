<?php

namespace FondOfOryx\Client\ErpOrderPageSearch\Plugin\SearchExtension;

use DateTime;
use Elastica\Query;
use Elastica\Query\BoolQuery;
use Elastica\Query\Range;
use FondOfOryx\Shared\ErpOrderPageSearch\ErpOrderPageSearchConstants;
use Generated\Shared\Search\ErpOrderIndexMap;
use InvalidArgumentException;
use Spryker\Client\Kernel\AbstractPlugin;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryExpanderPluginInterface;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface;

class ToDateErpOrderPageSearchQueryExpanderPlugin extends AbstractPlugin implements QueryExpanderPluginInterface
{
    /**
     * @param \Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface $searchQuery
     * @param array $requestParameters
     *
     * @return \Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface
     */
    public function expandQuery(QueryInterface $searchQuery, array $requestParameters = [])
    {
        if (!isset($requestParameters[ErpOrderPageSearchConstants::PARAMETER_TO])) {
            return $searchQuery;
        }

        $to = new DateTime($requestParameters[ErpOrderPageSearchConstants::PARAMETER_TO]);
        $boolQuery = $this->getBoolQuery($searchQuery->getSearchQuery());

        $toRange = (new Range())->addField(
            ErpOrderIndexMap::CREATED_AT,
            [
                'lte' => $to->format('Y-m-d H:i:s'),
            ],
        );

        $boolQuery->addFilter($toRange);

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
            throw new InvalidArgumentException(
                sprintf(
                    'Query expander available only with %s, got: %s',
                    BoolQuery::class,
                    get_class($boolQuery),
                ),
            );
        }

        return $boolQuery;
    }
}
