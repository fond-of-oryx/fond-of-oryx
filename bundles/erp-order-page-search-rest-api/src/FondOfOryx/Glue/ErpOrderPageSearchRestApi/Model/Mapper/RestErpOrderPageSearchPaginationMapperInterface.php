<?php

namespace FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Mapper;

use Generated\Shared\Transfer\RestErpOrderPageSearchPaginationTransfer;

interface RestErpOrderPageSearchPaginationMapperInterface
{
    /**
     * @param array $searchResult
     *
     * @return \Generated\Shared\Transfer\RestErpOrderPageSearchPaginationTransfer|null
     */
    public function fromSearchResult(array $searchResult): ?RestErpOrderPageSearchPaginationTransfer;
}
