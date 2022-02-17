<?php

declare(strict_types = 1);

namespace FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Model\Mapper;

use Generated\Shared\Transfer\RestErpDeliveryNotePageSearchCollectionResponseTransfer;

interface ErpDeliveryNoteMapperInterface
{
    /**
     * @param array $searchResults
     *
     * @return \Generated\Shared\Transfer\RestErpDeliveryNotePageSearchCollectionResponseTransfer
     */
    public function mapErpDeliveryNoteResource(
        array $searchResults
    ): RestErpDeliveryNotePageSearchCollectionResponseTransfer;
}
