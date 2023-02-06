<?php

namespace FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Mapper;

use Generated\Shared\Transfer\RestErpOrderPageSearchPaginationSortTransfer;
use Generated\Shared\Transfer\SortSearchResultTransfer;

class RestErpOrderPageSearchPaginationSortMapper implements RestErpOrderPageSearchPaginationSortMapperInterface
{
    /**
     * @param array $searchResult
     *
     * @return \Generated\Shared\Transfer\RestErpOrderPageSearchPaginationSortTransfer|null
     */
    public function fromSearchResult(array $searchResult): ?RestErpOrderPageSearchPaginationSortTransfer
    {
        if (!isset($searchResult['sort']) || !($searchResult['sort'] instanceof SortSearchResultTransfer)) {
            return null;
        }

        return (new RestErpOrderPageSearchPaginationSortTransfer())
            ->fromArray($searchResult['sort']->toArray(), true);
    }
}
