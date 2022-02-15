<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Business\PluginExecutor;

use Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer;

interface ErpDeliveryNoteItemPluginExecutorInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer $erpDeliveryNoteItemTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer
     */
    public function executePostSavePlugins(ErpDeliveryNoteItemTransfer $erpDeliveryNoteItemTransfer): ErpDeliveryNoteItemTransfer;

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer $erpDeliveryNoteItemTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer
     */
    public function executePreSavePlugins(ErpDeliveryNoteItemTransfer $erpDeliveryNoteItemTransfer): ErpDeliveryNoteItemTransfer;
}
