<?php

namespace FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin;

use Generated\Shared\Transfer\ErpInvoiceExpenseTransfer;
use Generated\Shared\Transfer\ErpInvoiceTransfer;

interface ErpInvoiceExpensePostSavePluginInterface
{
    /**
     * Specification:
     * - Plugin is triggered after erp invoice expense object was saved.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ErpInvoiceExpenseTransfer $erpInvoiceExpenseTransfer
     * @param \Generated\Shared\Transfer\ErpInvoiceTransfer|null $existingErpInvoiceTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceExpenseTransfer
     */
    public function postSave(
        ErpInvoiceExpenseTransfer $erpInvoiceExpenseTransfer,
        ?ErpInvoiceTransfer $existingErpInvoiceTransfer = null
    ): ErpInvoiceExpenseTransfer;
}
