<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Business\PluginExecutor;

use Generated\Shared\Transfer\ErpDeliveryNoteExpenseTransfer;

interface ErpDeliveryNoteExpensePluginExecutorInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteExpenseTransfer $erpDeliveryNoteExpenseTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteExpenseTransfer
     */
    public function executePostSavePlugins(ErpDeliveryNoteExpenseTransfer $erpDeliveryNoteExpenseTransfer): ErpDeliveryNoteExpenseTransfer;

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteExpenseTransfer $erpDeliveryNoteExpenseTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteExpenseTransfer
     */
    public function executePreSavePlugins(ErpDeliveryNoteExpenseTransfer $erpDeliveryNoteExpenseTransfer): ErpDeliveryNoteExpenseTransfer;
}
