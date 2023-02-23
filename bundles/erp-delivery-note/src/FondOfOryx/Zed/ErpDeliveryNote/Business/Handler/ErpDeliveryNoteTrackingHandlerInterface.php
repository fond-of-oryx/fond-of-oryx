<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Business\Handler;

use ArrayObject;
use FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Reader\ErpDeliveryNoteTrackingReaderInterface;
use FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Writer\ErpDeliveryNoteTrackingWriterInterface;
use Generated\Shared\Transfer\ErpDeliveryNoteTrackingCollectionTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteTrackingTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteTransfer;

interface ErpDeliveryNoteTrackingHandlerInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTransfer|null $existingErpDeliveryNoteTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteTransfer
     */
    public function handle(
        ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer,
        ?ErpDeliveryNoteTransfer $existingErpDeliveryNoteTransfer = null
    ): ErpDeliveryNoteTransfer;
}
