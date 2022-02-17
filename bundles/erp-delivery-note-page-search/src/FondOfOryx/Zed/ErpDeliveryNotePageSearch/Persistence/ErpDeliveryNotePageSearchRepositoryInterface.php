<?php

namespace FondOfOryx\Zed\ErpDeliveryNotePageSearch\Persistence;

use Generated\Shared\Transfer\FilterTransfer;

interface ErpDeliveryNotePageSearchRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\FilterTransfer $filterTransfer
     * @param array<int> $erpDeliveryNoteIds
     *
     * @return array<\Generated\Shared\Transfer\FooErpDeliveryNotePageSearchEntityTransfer>
     */
    public function findFilteredErpDeliveryNotePageSearchEntities(
        FilterTransfer $filterTransfer,
        array $erpDeliveryNoteIds = []
    ): array;
}
