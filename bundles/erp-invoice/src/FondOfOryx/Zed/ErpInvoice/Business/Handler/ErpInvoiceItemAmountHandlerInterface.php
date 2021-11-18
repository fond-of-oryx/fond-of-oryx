<?php

namespace FondOfOryx\Zed\ErpInvoice\Business\Handler;

use Generated\Shared\Transfer\ErpInvoiceItemTransfer;
use Generated\Shared\Transfer\ErpInvoiceTransfer;

interface ErpInvoiceItemAmountHandlerInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceItemTransfer $erpInvoiceItemTransfer
     * @param \Generated\Shared\Transfer\ErpInvoiceTransfer|null $existingErpInvoiceTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceItemTransfer
     */
    public function handle(ErpInvoiceItemTransfer $erpInvoiceItemTransfer, ?ErpInvoiceTransfer $existingErpInvoiceTransfer = null): ErpInvoiceItemTransfer;
}
