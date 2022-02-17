<?php

namespace FondOfOryx\Client\ErpDeliveryNotePageSearch\Plugin\SearchExtension;

use Elastica\ResultSet;
use Generated\Shared\Search\ErpDeliveryNoteIndexMap;
use Spryker\Client\SearchElasticsearch\Plugin\ResultFormatter\AbstractElasticsearchResultFormatterPlugin;

class RawErpDeliveryNotePageSearchResultFormatterPlugin extends AbstractElasticsearchResultFormatterPlugin
{
    /**
     * @var string
     */
    public const NAME = 'erp-delivery-notes';

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
        $rawErpDeliveryNotes = [];
        foreach ($searchResult->getResults() as $document) {
            $rawErpDeliveryNotes[] = $document->getSource()[ErpDeliveryNoteIndexMap::SEARCH_RESULT_DATA];
        }

        return $rawErpDeliveryNotes;
    }
}
