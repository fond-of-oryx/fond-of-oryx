<?php

namespace FondOfOryx\Zed\ErpInvoice\Business\Model\Writer;

use Generated\Shared\Transfer\ErpInvoiceAddressTransfer;

interface ErpInvoiceAddressWriterInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceAddressTransfer $erpInvoiceAddressTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceAddressTransfer
     */
    public function create(ErpInvoiceAddressTransfer $erpInvoiceAddressTransfer): ErpInvoiceAddressTransfer;

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceAddressTransfer $erpInvoiceAddressTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceAddressTransfer
     */
    public function update(ErpInvoiceAddressTransfer $erpInvoiceAddressTransfer): ErpInvoiceAddressTransfer;

    /**
     * @param int $idErpInvoiceAddress
     *
     * @return void
     */
    public function delete(int $idErpInvoiceAddress): void;
}
