<?php

namespace FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Mapper;

use Generated\Shared\Transfer\PaginationSearchResultTransfer;
use Generated\Shared\Transfer\RestErpDeliveryNotePageSearchPaginationTransfer;

class RestErpDeliveryNotePageSearchPaginationMapper implements RestErpDeliveryNotePageSearchPaginationMapperInterface
{
    /**
     * @param array $searchResult
     *
     * @return \Generated\Shared\Transfer\RestErpDeliveryNotePageSearchPaginationTransfer|null
     */
    public function fromSearchResult(array $searchResult): ?RestErpDeliveryNotePageSearchPaginationTransfer
    {
        if (!isset($searchResult['pagination']) || !($searchResult['pagination'] instanceof PaginationSearchResultTransfer)) {
            return null;
        }

        return (new RestErpDeliveryNotePageSearchPaginationTransfer())
            ->fromArray($searchResult['pagination']->toArray(), true);
    }
}
