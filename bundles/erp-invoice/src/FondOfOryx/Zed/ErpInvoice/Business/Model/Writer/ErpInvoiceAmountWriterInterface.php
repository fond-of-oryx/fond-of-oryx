<?php

namespace FondOfOryx\Zed\ErpInvoice\Business\Model\Writer;

use Generated\Shared\Transfer\ErpInvoiceAmountTransfer;

interface ErpInvoiceAmountWriterInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceAmountTransfer $erpInvoiceAmountTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceAmountTransfer
     */
    public function create(ErpInvoiceAmountTransfer $erpInvoiceAmountTransfer): ErpInvoiceAmountTransfer;

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceAmountTransfer $erpInvoiceAmountTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceAmountTransfer
     */
    public function update(ErpInvoiceAmountTransfer $erpInvoiceAmountTransfer): ErpInvoiceAmountTransfer;
}
