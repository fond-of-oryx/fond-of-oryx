<?php

namespace FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin;

use Generated\Shared\Transfer\ErpInvoiceAmountTransfer;
use Generated\Shared\Transfer\ErpInvoiceTransfer;

interface ErpInvoiceAmountPostSavePluginInterface
{
    /**
     * Specification:
     * - Plugin is triggered after erp invoice total object was saved.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ErpInvoiceAmountTransfer $erpInvoiceAmountTransfer
     * @param \Generated\Shared\Transfer\ErpInvoiceTransfer|null $existingErpInvoiceTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceAmountTransfer
     */
    public function postSave(
        ErpInvoiceAmountTransfer $erpInvoiceAmountTransfer,
        ?ErpInvoiceTransfer $existingErpInvoiceTransfer = null
    ): ErpInvoiceAmountTransfer;
}
