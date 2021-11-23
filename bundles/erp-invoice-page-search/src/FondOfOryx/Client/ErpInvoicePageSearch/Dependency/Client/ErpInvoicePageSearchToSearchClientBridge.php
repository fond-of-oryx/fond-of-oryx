<?php

namespace FondOfOryx\Client\ErpInvoicePageSearch\Dependency\Client;

use Spryker\Client\Search\SearchClientInterface;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface;

class ErpInvoicePageSearchToSearchClientBridge implements ErpInvoicePageSearchToSearchClientInterface
{
    /**
     * @var \Spryker\Client\Search\SearchClientInterface
     */
    protected $searchClient;

    /**
     * @param \Spryker\Client\Search\SearchClientInterface $searchClient
     */
    public function __construct(SearchClientInterface $searchClient)
    {
        $this->searchClient = $searchClient;
    }

    /**
     * @param \Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface $searchQuery
     * @param array<\Spryker\Client\SearchExtension\Dependency\Plugin\ResultFormatterPluginInterface> $resultFormatters
     * @param array $requestParameters
     *
     * @return mixed
     */
    public function search(
        QueryInterface $searchQuery,
        array $resultFormatters = [],
        array $requestParameters = []
    ) {
        return $this->searchClient->search($searchQuery, $resultFormatters, $requestParameters);
    }

    /**
     * @param \Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface $searchQuery
     * @param array<\Spryker\Client\SearchExtension\Dependency\Plugin\QueryExpanderPluginInterface> $searchQueryExpanders
     * @param array $requestParameters
     *
     * @return \Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface
     */
    public function expandQuery(
        QueryInterface $searchQuery,
        array $searchQueryExpanders,
        array $requestParameters = []
    ): QueryInterface {
        return $this->searchClient->expandQuery($searchQuery, $searchQueryExpanders, $requestParameters);
    }
}
