<?php

namespace FondOfOryx\Client\ErpOrderPageSearch;

use Generated\Shared\Transfer\ErpOrderCollectionTransfer;
use Generated\Shared\Transfer\ErpOrderPageSearchRequestTransfer;

/**
 * Interface ErpOrderPageSearchClientInterface
 *
 * @package FondOfOryx\Client\ErpOrderPageSearch
 */
interface ErpOrderPageSearchClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpOrderPageSearchRequestTransfer $request
     *
     * @return \Generated\Shared\Transfer\ErpOrderCollectionTransfer
     */
    public function findErpOrdersByFilterTransfer(ErpOrderPageSearchRequestTransfer $request): ErpOrderCollectionTransfer;

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
     * @return array
     */
    public function search(string $searchString, array $requestParameters = []): array;
}
