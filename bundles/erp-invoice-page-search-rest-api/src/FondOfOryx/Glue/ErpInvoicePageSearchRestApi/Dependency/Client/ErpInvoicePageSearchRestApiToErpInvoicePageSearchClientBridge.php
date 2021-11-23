<?php

namespace FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Dependency\Client;

use FondOfOryx\Client\ErpInvoicePageSearch\ErpInvoicePageSearchClientInterface;

class ErpInvoicePageSearchRestApiToErpInvoicePageSearchClientBridge implements ErpInvoicePageSearchRestApiToErpInvoicePageSearchClientInterface
{
    /**
     * @var \FondOfOryx\Client\ErpInvoicePageSearch\ErpInvoicePageSearchClientInterface
     */
    protected $client;

    /**
     * @param \FondOfOryx\Client\ErpInvoicePageSearch\ErpInvoicePageSearchClientInterface $client
     */
    public function __construct(ErpInvoicePageSearchClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * Specification:
     * - A query based on the given search string and request parameters will be executed
     * - The query will also create facet aggregations, pagination and sorting based on the request parameters
     * - The result is a formatted associative array where the used result formatters' name are the keys and their results are the values
     *
     * @api
     *
     * @param string $searchString
     * @param array $requestParameters
     *
     * @return mixed
     */
    public function search(string $searchString, array $requestParameters = [])
    {
        return $this->client->search($searchString, $requestParameters);
    }
}
