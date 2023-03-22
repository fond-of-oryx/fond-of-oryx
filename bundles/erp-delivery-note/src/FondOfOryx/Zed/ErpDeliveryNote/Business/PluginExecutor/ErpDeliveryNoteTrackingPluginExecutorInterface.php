<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Business\PluginExecutor;

use Generated\Shared\Transfer\ErpDeliveryNoteTrackingTransfer;

interface ErpDeliveryNoteTrackingPluginExecutorInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTrackingTransfer $erpDeliveryNoteTrackingTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteTrackingTransfer
     */
    public function executePostSavePlugins(ErpDeliveryNoteTrackingTransfer $erpDeliveryNoteTrackingTransfer): ErpDeliveryNoteTrackingTransfer;

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTrackingTransfer $erpDeliveryNoteTrackingTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteTrackingTransfer
     */
    public function executePreSavePlugins(ErpDeliveryNoteTrackingTransfer $erpDeliveryNoteTrackingTransfer): ErpDeliveryNoteTrackingTransfer;
}
