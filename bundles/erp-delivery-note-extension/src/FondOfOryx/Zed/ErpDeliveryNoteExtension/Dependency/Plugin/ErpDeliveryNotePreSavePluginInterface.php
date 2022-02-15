<?php

namespace FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin;

use Generated\Shared\Transfer\ErpDeliveryNoteTransfer;

interface ErpDeliveryNotePreSavePluginInterface
{
    /**
     * Specification:
     * - Plugin is triggered before erp delivery note object is saved.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTransfer|null $existingErpDeliveryNoteTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteTransfer
     */
    public function preSave(
        ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer,
        ?ErpDeliveryNoteTransfer $existingErpDeliveryNoteTransfer = null
    ): ErpDeliveryNoteTransfer;
}
