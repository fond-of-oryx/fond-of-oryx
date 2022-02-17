<?php

namespace FondOfOryx\Client\ErpDeliveryNotePageSearch\Plugin\SearchExtension;

use Elastica\Query;
use Elastica\Query\BoolQuery;
use Elastica\Query\Terms;
use FondOfOryx\Shared\ErpDeliveryNotePageSearch\ErpDeliveryNotePageSearchConstants;
use Generated\Shared\Search\ErpDeliveryNoteIndexMap;
use InvalidArgumentException;
use Spryker\Client\Kernel\AbstractPlugin;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryExpanderPluginInterface;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface;

class ExternalReferenceErpDeliveryNotePageSearchQueryExpanderPlugin extends AbstractPlugin implements
    QueryExpanderPluginInterface
{
    /**
     * @param \Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface $searchQuery
     * @param array $requestParameters
     *
     * @return \Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface
     */
    public function expandQuery(QueryInterface $searchQuery, array $requestParameters = []): QueryInterface
    {
        if (!isset($requestParameters[ErpDeliveryNotePageSearchConstants::PARAMETER_EXTERNAL_REFERENCE])) {
            return $searchQuery;
        }

        $externalReferences = $requestParameters[ErpDeliveryNotePageSearchConstants::PARAMETER_EXTERNAL_REFERENCE];

        if (!is_array($externalReferences) || count($externalReferences) === 0) {
            return $searchQuery;
        }

        $this->getBoolQuery($searchQuery->getSearchQuery())
            ->addMust(new Terms(ErpDeliveryNoteIndexMap::EXTERNAL_REFERENCE, $externalReferences));

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
