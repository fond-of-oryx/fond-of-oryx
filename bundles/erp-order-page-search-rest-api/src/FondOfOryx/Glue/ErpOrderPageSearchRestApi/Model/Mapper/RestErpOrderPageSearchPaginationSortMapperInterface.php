<?php

namespace FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Mapper;

use Generated\Shared\Transfer\RestErpOrderPageSearchPaginationSortTransfer;

interface RestErpOrderPageSearchPaginationSortMapperInterface
{
    /**
     * @param array $searchResult
     *
     * @return \Generated\Shared\Transfer\RestErpOrderPageSearchPaginationSortTransfer|null
     */
    public function fromSearchResult(array $searchResult): ?RestErpOrderPageSearchPaginationSortTransfer;
}
