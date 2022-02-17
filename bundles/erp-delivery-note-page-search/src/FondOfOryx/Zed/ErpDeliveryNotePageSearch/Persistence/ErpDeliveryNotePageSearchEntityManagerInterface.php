<?php

namespace FondOfOryx\Zed\ErpDeliveryNotePageSearch\Persistence;

use Generated\Shared\Transfer\ErpDeliveryNotePageSearchTransfer;

interface ErpDeliveryNotePageSearchEntityManagerInterface
{
    /**
     * @param array $erpDeliveryNoteIds
     *
     * @return void
     */
    public function deleteErpDeliveryNoteSearchPagesByErpDeliveryNoteIds(array $erpDeliveryNoteIds): void;

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNotePageSearchTransfer $erpDeliveryNotePageSearchTransfer
     *
     * @return void
     */
    public function createErpDeliveryNotePageSearch(ErpDeliveryNotePageSearchTransfer $erpDeliveryNotePageSearchTransfer): void;
}
