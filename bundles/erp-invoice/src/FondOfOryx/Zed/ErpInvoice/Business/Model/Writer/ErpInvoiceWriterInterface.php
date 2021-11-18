<?php

namespace FondOfOryx\Zed\ErpInvoice\Business\Model\Writer;

use Generated\Shared\Transfer\ErpInvoiceResponseTransfer;
use Generated\Shared\Transfer\ErpInvoiceTransfer;

interface ErpInvoiceWriterInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceTransfer $erpInvoiceTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceResponseTransfer
     */
    public function create(ErpInvoiceTransfer $erpInvoiceTransfer): ErpInvoiceResponseTransfer;

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceTransfer $erpInvoiceTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceResponseTransfer
     */
    public function update(ErpInvoiceTransfer $erpInvoiceTransfer): ErpInvoiceResponseTransfer;

    /**
     * @param int $idErpInvoice
     *
     * @return void
     */
    public function delete(int $idErpInvoice): void;
}
