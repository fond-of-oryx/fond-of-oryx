<?php

namespace FondOfOryx\Zed\Invoice\Business\Model;

use Generated\Shared\Transfer\InvoiceResponseTransfer;
use Generated\Shared\Transfer\InvoiceTransfer;

interface InvoiceWriterInterface
{
    /**
     * @param \Generated\Shared\Transfer\InvoiceTransfer $invoiceTransfer
     *
     * @return \Generated\Shared\Transfer\InvoiceResponseTransfer
     */
    public function create(
        InvoiceTransfer $invoiceTransfer
    ): InvoiceResponseTransfer;
}
