<?php

namespace FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Mapper;

use Generated\Shared\Transfer\RestErpDeliveryNotePageSearchPaginationTransfer;

interface RestErpDeliveryNotePageSearchPaginationMapperInterface
{
    /**
     * @param array $searchResult
     *
     * @return \Generated\Shared\Transfer\RestErpDeliveryNotePageSearchPaginationTransfer|null
     */
    public function fromSearchResult(array $searchResult): ?RestErpDeliveryNotePageSearchPaginationTransfer;
}
