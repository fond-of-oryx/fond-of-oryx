<?php

namespace FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin;

use Generated\Shared\Transfer\ErpDeliveryNoteExpenseTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteTransfer;

interface ErpDeliveryNoteExpensePostSavePluginInterface
{
    /**
     * Specification:
     * - Plugin is triggered after erp delivery note expense object was saved.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteExpenseTransfer $erpDeliveryNoteExpenseTransfer
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTransfer|null $existingErpDeliveryNoteTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteExpenseTransfer
     */
    public function postSave(
        ErpDeliveryNoteExpenseTransfer $erpDeliveryNoteExpenseTransfer,
        ?ErpDeliveryNoteTransfer $existingErpDeliveryNoteTransfer = null
    ): ErpDeliveryNoteExpenseTransfer;
}
