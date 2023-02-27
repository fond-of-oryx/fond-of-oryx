<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Reader;

use Generated\Shared\Transfer\ErpDeliveryNoteTrackingCollectionTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteTrackingTransfer;

interface ErpDeliveryNoteTrackingReaderInterface
{
    /**
     * @param int $idErpDeliveryNote
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteTrackingCollectionTransfer
     */
    public function findErpDeliveryNoteTrackingByIdErpDeliveryNote(int $idErpDeliveryNote): ErpDeliveryNoteTrackingCollectionTransfer;

    /**
     * @param int $idErpDeliveryNoteTracking
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteTrackingTransfer|null
     */
    public function findErpDeliveryNoteTrackingByIdErpDeliveryNoteTracking(int $idErpDeliveryNoteTracking): ?ErpDeliveryNoteTrackingTransfer;
}
