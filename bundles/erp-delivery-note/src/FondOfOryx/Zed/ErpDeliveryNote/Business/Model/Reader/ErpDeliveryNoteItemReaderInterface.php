<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Reader;

use Generated\Shared\Transfer\ErpDeliveryNoteItemCollectionTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer;

interface ErpDeliveryNoteItemReaderInterface
{
    /**
     * @param int $idErpDeliveryNoteItem
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer|null
     */
    public function findErpDeliveryNoteItemByIdErpDeliveryNoteItem(int $idErpDeliveryNoteItem): ?ErpDeliveryNoteItemTransfer;

    /**
     * @param int $idErpDeliveryNote
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteItemCollectionTransfer
     */
    public function findErpDeliveryNoteItemsByIdErpDeliveryNote(int $idErpDeliveryNote): ErpDeliveryNoteItemCollectionTransfer;
}
