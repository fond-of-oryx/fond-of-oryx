<?php

namespace FondOfOryx\Glue\ErpOrderPageSearchRestApi\Dependency\Client;

use FondOfOryx\Client\ErpOrderPageSearch\ErpOrderPageSearchClientInterface;

class ErpOrderPageSearchRestApiToErpOrderPageSearchClientBridge implements ErpOrderPageSearchRestApiToErpOrderPageSearchClientInterface
{
    /**
     * @var \FondOfOryx\Client\ErpOrderPageSearch\ErpOrderPageSearchClientInterface
     */
    protected $client;

    /**
     * @param \FondOfOryx\Client\ErpOrderPageSearch\ErpOrderPageSearchClientInterface $client
     */
    public function __construct(ErpOrderPageSearchClientInterface $client)
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
