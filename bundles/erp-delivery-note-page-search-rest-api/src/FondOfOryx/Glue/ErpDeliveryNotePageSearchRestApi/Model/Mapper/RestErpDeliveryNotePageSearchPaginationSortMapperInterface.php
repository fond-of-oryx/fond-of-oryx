<?php

namespace FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Mapper;

use Generated\Shared\Transfer\RestErpDeliveryNotePageSearchPaginationSortTransfer;

interface RestErpDeliveryNotePageSearchPaginationSortMapperInterface
{
    /**
     * @param array $searchResult
     *
     * @return \Generated\Shared\Transfer\RestErpDeliveryNotePageSearchPaginationSortTransfer|null
     */
    public function fromSearchResult(array $searchResult): ?RestErpDeliveryNotePageSearchPaginationSortTransfer;
}
