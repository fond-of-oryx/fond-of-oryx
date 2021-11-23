<?php

namespace FondOfOryx\Client\ErpInvoicePageSearch\Plugin\SearchExtension;

use Elastica\ResultSet;
use Generated\Shared\Search\ErpInvoiceIndexMap;
use Spryker\Client\SearchElasticsearch\Plugin\ResultFormatter\AbstractElasticsearchResultFormatterPlugin;

class RawErpInvoicePageSearchResultFormatterPlugin extends AbstractElasticsearchResultFormatterPlugin
{
    /**
     * @var string
     */
    public const NAME = 'erp-invoices';

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
        $rawErpInvoices = [];
        foreach ($searchResult->getResults() as $document) {
            $rawErpInvoices[] = $document->getSource()[ErpInvoiceIndexMap::SEARCH_RESULT_DATA];
        }

        return $rawErpInvoices;
    }
}
