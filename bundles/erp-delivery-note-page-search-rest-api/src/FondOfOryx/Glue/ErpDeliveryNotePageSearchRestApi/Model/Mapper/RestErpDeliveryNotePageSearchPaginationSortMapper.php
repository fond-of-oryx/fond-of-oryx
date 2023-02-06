<?php

namespace FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Mapper;

use Generated\Shared\Transfer\RestErpDeliveryNotePageSearchPaginationSortTransfer;
use Generated\Shared\Transfer\SortSearchResultTransfer;

class RestErpDeliveryNotePageSearchPaginationSortMapper implements RestErpDeliveryNotePageSearchPaginationSortMapperInterface
{
    /**
     * @param array $searchResult
     *
     * @return \Generated\Shared\Transfer\RestErpDeliveryNotePageSearchPaginationSortTransfer|null
     */
    public function fromSearchResult(array $searchResult): ?RestErpDeliveryNotePageSearchPaginationSortTransfer
    {
        if (!isset($searchResult['sort']) || !($searchResult['sort'] instanceof SortSearchResultTransfer)) {
            return null;
        }

        return (new RestErpDeliveryNotePageSearchPaginationSortTransfer())
            ->fromArray($searchResult['sort']->toArray(), true);
    }
}
