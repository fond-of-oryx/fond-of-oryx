<?php

namespace FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin;

use Generated\Shared\Transfer\ErpDeliveryNoteTransfer;

interface ErpDeliveryNotePostSavePluginInterface
{
    /**
     * Specification:
     * - Plugin is triggered after erp delivery note object was saved.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTransfer|null $existingErpDeliveryNoteTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteTransfer
     */
    public function postSave(
        ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer,
        ?ErpDeliveryNoteTransfer $existingErpDeliveryNoteTransfer = null
    ): ErpDeliveryNoteTransfer;
}
