<?php

namespace FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin;

use Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteTransfer;

interface ErpDeliveryNoteItemPreSavePluginInterface
{
    /**
     * Specification:
     * - Plugin is triggered before erp delivery note item object is saved.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer $erpDeliveryNoteItemTransfer
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTransfer|null $existingErpDeliveryNoteTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer
     */
    public function preSave(
        ErpDeliveryNoteItemTransfer $erpDeliveryNoteItemTransfer,
        ?ErpDeliveryNoteTransfer $existingErpDeliveryNoteTransfer = null
    ): ErpDeliveryNoteItemTransfer;
}
