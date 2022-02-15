<?php

namespace FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin;

use Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteTransfer;

interface ErpDeliveryNoteItemPostSavePluginInterface
{
    /**
     * Specification:
     * - Plugin is triggered after erp delivery note item object was saved.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer $erpDeliveryNoteItemTransfer
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTransfer|null $existingErpDeliveryNoteTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer
     */
    public function postSave(
        ErpDeliveryNoteItemTransfer $erpDeliveryNoteItemTransfer,
        ?ErpDeliveryNoteTransfer $existingErpDeliveryNoteTransfer = null
    ): ErpDeliveryNoteItemTransfer;
}
