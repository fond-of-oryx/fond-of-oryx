<?php

namespace FondOfOryx\Zed\Invoice\Persistence;

use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\InvoiceTransfer;
use Generated\Shared\Transfer\ItemTransfer;

interface InvoiceEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\InvoiceTransfer $invoiceTransfer
     *
     * @return \Generated\Shared\Transfer\InvoiceTransfer
     */
    public function createInvoice(InvoiceTransfer $invoiceTransfer): InvoiceTransfer;

    /**
     * @param \Generated\Shared\Transfer\AddressTransfer $addressTransfer
     *
     * @return \Generated\Shared\Transfer\AddressTransfer
     */
    public function createInvoiceAddress(AddressTransfer $addressTransfer): AddressTransfer;

    /**
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     *
     * @return \Generated\Shared\Transfer\ItemTransfer
     */
    public function createInvoiceItem(ItemTransfer $itemTransfer): ItemTransfer;
}
