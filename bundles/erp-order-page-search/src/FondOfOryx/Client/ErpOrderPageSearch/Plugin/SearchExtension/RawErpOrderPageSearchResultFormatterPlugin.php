<?php

namespace FondOfOryx\Client\ErpOrderPageSearch\Plugin\SearchExtension;

use Elastica\ResultSet;
use Generated\Shared\Search\ErpOrderIndexMap;
use Spryker\Client\SearchElasticsearch\Plugin\ResultFormatter\AbstractElasticsearchResultFormatterPlugin;

class RawErpOrderPageSearchResultFormatterPlugin extends AbstractElasticsearchResultFormatterPlugin
{
    public const NAME = 'erp-orders';

    /**
     * @return string
     */
    public function getName()
    {
        return static::NAME;
    }

    /**
     * @param \Elastica\ResultSet $searchResult
     * @param array $requestParameters
     *
     * @return mixed
     */
    public function formatSearchResult(ResultSet $searchResult, array $requestParameters = [])
    {
        $rawErpOrders = [];
        foreach ($searchResult->getResults() as $document) {
            $rawErpOrders[] = $document->getSource()[ErpOrderIndexMap::SEARCH_RESULT_DATA];
        }

        return $rawErpOrders;
    }
}
