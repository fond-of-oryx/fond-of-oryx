<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Writer;

use Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer;

interface ErpDeliveryNoteItemWriterInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer $erpDeliveryNoteItemTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer
     */
    public function create(ErpDeliveryNoteItemTransfer $erpDeliveryNoteItemTransfer): ErpDeliveryNoteItemTransfer;

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer $erpDeliveryNoteItemTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer
     */
    public function update(ErpDeliveryNoteItemTransfer $erpDeliveryNoteItemTransfer): ErpDeliveryNoteItemTransfer;

    /**
     * @param int $idErpDeliveryNoteItem
     *
     * @return void
     */
    public function delete(int $idErpDeliveryNoteItem): void;
}
