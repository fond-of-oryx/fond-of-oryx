<?php

declare(strict_types = 1);

namespace FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Mapper;

use Generated\Shared\Transfer\RestErpDeliveryNotePageSearchCollectionResponseTransfer;

interface RestErpDeliveryNotePageSearchCollectionResponseMapperInterface
{
    /**
     * @param array $searchResult
     *
     * @return \Generated\Shared\Transfer\RestErpDeliveryNotePageSearchCollectionResponseTransfer
     */
    public function fromSearchResult(
        array $searchResult
    ): RestErpDeliveryNotePageSearchCollectionResponseTransfer;
}
