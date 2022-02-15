<?php

namespace FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin;

use Generated\Shared\Transfer\ErpDeliveryNoteAddressTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteTransfer;

interface ErpDeliveryNoteAddressPostSavePluginInterface
{
    /**
     * Specification:
     * - Plugin is triggered after erp delivery note address object was saved.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteAddressTransfer $erpDeliveryNoteAddressTransfer
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTransfer|null $existingErpDeliveryNoteTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteAddressTransfer
     */
    public function postSave(
        ErpDeliveryNoteAddressTransfer $erpDeliveryNoteAddressTransfer,
        ?ErpDeliveryNoteTransfer $existingErpDeliveryNoteTransfer = null
    ): ErpDeliveryNoteAddressTransfer;
}
