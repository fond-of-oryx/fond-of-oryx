<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Writer;

use Generated\Shared\Transfer\ErpDeliveryNoteTrackingTransfer;

interface ErpDeliveryNoteTrackingWriterInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTrackingTransfer $erpDeliveryNoteTrackingTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteTrackingTransfer
     */
    public function create(ErpDeliveryNoteTrackingTransfer $erpDeliveryNoteTrackingTransfer): ErpDeliveryNoteTrackingTransfer;

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTrackingTransfer $erpDeliveryNoteTrackingTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteTrackingTransfer
     */
    public function update(ErpDeliveryNoteTrackingTransfer $erpDeliveryNoteTrackingTransfer): ErpDeliveryNoteTrackingTransfer;

    /**
     * @param int $idErpDeliveryNoteTracking
     *
     * @return void
     */
    public function delete(int $idErpDeliveryNoteTracking): void;
}
