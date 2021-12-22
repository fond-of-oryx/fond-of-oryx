<?php

namespace FondOfOryx\Zed\Invoice\Business\Model;

use Generated\Shared\Transfer\InvoiceTransfer;

interface InvoiceAddressWriterInterface
{
    /**
     * @param \Generated\Shared\Transfer\InvoiceTransfer $invoiceTransfer
     *
     * @return \Generated\Shared\Transfer\InvoiceTransfer
     */
    public function create(InvoiceTransfer $invoiceTransfer): InvoiceTransfer;
}
