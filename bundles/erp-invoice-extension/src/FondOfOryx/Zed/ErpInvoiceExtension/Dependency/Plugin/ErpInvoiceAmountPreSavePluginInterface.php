<?php

namespace FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin;

use Generated\Shared\Transfer\ErpInvoiceAmountTransfer;
use Generated\Shared\Transfer\ErpInvoiceTransfer;

interface ErpInvoiceAmountPreSavePluginInterface
{
    /**
     * Specification:
     * - Plugin is triggered before erp invoice amount object is saved.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ErpInvoiceAmountTransfer $erpInvoiceAmountTransfer
     * @param \Generated\Shared\Transfer\ErpInvoiceTransfer|null $existingErpInvoiceTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceAmountTransfer
     */
    public function preSave(
        ErpInvoiceAmountTransfer $erpInvoiceAmountTransfer,
        ?ErpInvoiceTransfer $existingErpInvoiceTransfer = null
    ): ErpInvoiceAmountTransfer;
}
