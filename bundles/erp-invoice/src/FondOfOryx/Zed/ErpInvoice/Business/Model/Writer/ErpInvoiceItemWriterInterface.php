<?php

namespace FondOfOryx\Zed\ErpInvoice\Business\Model\Writer;

use Generated\Shared\Transfer\ErpInvoiceItemTransfer;

interface ErpInvoiceItemWriterInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceItemTransfer $erpInvoiceItemTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceItemTransfer
     */
    public function create(ErpInvoiceItemTransfer $erpInvoiceItemTransfer): ErpInvoiceItemTransfer;

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceItemTransfer $erpInvoiceItemTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceItemTransfer
     */
    public function update(ErpInvoiceItemTransfer $erpInvoiceItemTransfer): ErpInvoiceItemTransfer;

    /**
     * @param int $idErpInvoiceItem
     *
     * @return void
     */
    public function delete(int $idErpInvoiceItem): void;
}
