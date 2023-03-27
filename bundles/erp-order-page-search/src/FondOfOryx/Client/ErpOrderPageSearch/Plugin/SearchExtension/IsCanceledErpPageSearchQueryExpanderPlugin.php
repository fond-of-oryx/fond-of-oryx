<?php

namespace FondOfOryx\Client\ErpOrderPageSearch\Plugin\SearchExtension;

use Elastica\Query;
use Elastica\Query\BoolQuery;
use Elastica\Query\Term;
use FondOfOryx\Shared\ErpOrderPageSearch\ErpOrderPageSearchConstants;
use Generated\Shared\Search\ErpOrderIndexMap;
use InvalidArgumentException;
use Spryker\Client\Kernel\AbstractPlugin;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryExpanderPluginInterface;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface;

class IsCanceledErpPageSearchQueryExpanderPlugin extends AbstractPlugin implements QueryExpanderPluginInterface
{
    /**
     * @param \Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface $searchQuery
     * @param array $requestParameters
     *
     * @return \Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface
     */
    public function expandQuery(QueryInterface $searchQuery, array $requestParameters = [])
    {
        if (!isset($requestParameters[ErpOrderPageSearchConstants::PARAMETER_IS_CANCELED])) {
            return $searchQuery;
        }

        $isCanceled = $requestParameters[ErpOrderPageSearchConstants::PARAMETER_IS_CANCELED];

        $boolQuery = $this->getBoolQuery($searchQuery->getSearchQuery());

        $isCanceledTerm = (new Term())
            ->setTerm(ErpOrderIndexMap::IS_CANCELED, $isCanceled);

        $boolQuery->addMust($isCanceledTerm);

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
