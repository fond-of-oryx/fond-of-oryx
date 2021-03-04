<?php

namespace FondOfOryx\Client\ErpOrderPageSearch\Plugin\SearchExtension;

use Elastica\Query;
use Elastica\Query\BoolQuery;
use Elastica\Query\Terms;
use Exception;
use Generated\Shared\Transfer\ErpOrderPageSearchFilterTransfer;
use Spryker\Client\Kernel\AbstractPlugin;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryExpanderPluginInterface;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface;

/**
 * @method \FondOfOryx\Client\ErpOrderPageSearch\ErpOrderPageSearchFactory getFactory()
 */
abstract class AbstractErpOrderPageSearchQueryExpanderPlugin extends AbstractPlugin implements QueryExpanderPluginInterface
{
    /**
     * @param string $resource
     * @param string $field
     * @param array $filterData
     *
     * @return array
     */
    protected function getFilterData(string $resource, string $field, array $filterData): array
    {
        $filterCollection = [];

        if (array_key_exists($resource, $filterData) === false) {
            return $filterCollection;
        }

        foreach ($filterData[$resource] as $filter) {
            $filterTransfer = (new ErpOrderPageSearchFilterTransfer())->fromArray($filter, true);
            if ($filterTransfer->getResource() === $resource && $filterTransfer->getField() === $field) {
                $filterCollection[$filterTransfer->getValue()] = $filterTransfer;
            }
        }

        return $filterCollection;
    }

    /**
     * @param string $key
     * @param array $values
     * @param \Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface $searchQuery
     *
     * @return \Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface
     */
    protected function addTerms(string $key, array $values, QueryInterface $searchQuery): QueryInterface
    {
        if (count($values) === 0) {
            return $searchQuery;
        }

        $terms = (new Terms($key))->setTerms(
            $values
        );

        $this->getBoolQuery($searchQuery->getSearchQuery())->addMust($terms);

        return $searchQuery;
    }

    /**
     * @param \Elastica\Query $query
     *
     * @throws \Exception
     *
     * @return \Elastica\Query\BoolQuery
     */
    protected function getBoolQuery(Query $query): BoolQuery
    {
        $boolQuery = $query->getQuery();
        if (!$boolQuery instanceof BoolQuery) {
            throw new Exception(sprintf(
                'Wrong bool query provided with %s, got: %s',
                BoolQuery::class,
                get_class($boolQuery)
            ));
        }

        return $boolQuery;
    }
}
