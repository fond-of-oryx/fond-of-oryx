<?php

namespace FondOfOryx\Zed\Invoice\Business;

use Generated\Shared\Transfer\InvoiceResponseTransfer;
use Generated\Shared\Transfer\InvoiceTransfer;

interface InvoiceFacadeInterface
{
    /**
     * Specification:
     * - Creates invoice
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\InvoiceTransfer $invoiceTransfer
     *
     * @return \Generated\Shared\Transfer\InvoiceResponseTransfer
     */
    public function createInvoice(InvoiceTransfer $invoiceTransfer): InvoiceResponseTransfer;

    /**
     * Specification:
     * - Creates invoice address
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\InvoiceTransfer $invoiceTransfer
     *
     * @return \Generated\Shared\Transfer\InvoiceTransfer
     */
    public function createInvoiceAddress(
        InvoiceTransfer $invoiceTransfer
    ): InvoiceTransfer;

    /**
     * Specification:
     * - Creates invoice items
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\InvoiceTransfer $invoiceTransfer
     *
     * @return \Generated\Shared\Transfer\InvoiceTransfer
     */
    public function createInvoiceItems(
        InvoiceTransfer $invoiceTransfer
    ): InvoiceTransfer;

    /**
     * Specification:
     * - Creates invoice reference
     *
     * @api
     *
     * @return string
     */
    public function createInvoiceReference(): string;
}
