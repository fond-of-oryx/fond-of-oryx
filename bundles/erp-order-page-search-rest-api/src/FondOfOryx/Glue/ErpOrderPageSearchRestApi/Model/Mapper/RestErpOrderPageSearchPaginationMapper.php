<?php

namespace FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Mapper;

use Generated\Shared\Transfer\PaginationSearchResultTransfer;
use Generated\Shared\Transfer\RestErpOrderPageSearchPaginationTransfer;

class RestErpOrderPageSearchPaginationMapper implements RestErpOrderPageSearchPaginationMapperInterface
{
    /**
     * @param array $searchResult
     *
     * @return \Generated\Shared\Transfer\RestErpOrderPageSearchPaginationTransfer|null
     */
    public function fromSearchResult(array $searchResult): ?RestErpOrderPageSearchPaginationTransfer
    {
        if (!isset($searchResult['pagination']) || !($searchResult['pagination'] instanceof PaginationSearchResultTransfer)) {
            return null;
        }

        return (new RestErpOrderPageSearchPaginationTransfer())
            ->fromArray($searchResult['pagination']->toArray(), true);
    }
}
