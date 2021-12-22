<?php

namespace FondOfOryx\Zed\Invoice\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\InvoiceTransfer;
use Orm\Zed\Invoice\Persistence\FosInvoice;

interface InvoiceMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\InvoiceTransfer $invoiceTransfer
     * @param \Orm\Zed\Invoice\Persistence\FosInvoice $fosInvoice
     *
     * @return \Orm\Zed\Invoice\Persistence\FosInvoice
     */
    public function mapTransferToEntity(
        InvoiceTransfer $invoiceTransfer,
        FosInvoice $fosInvoice
    ): FosInvoice;

    /**
     * @param \Orm\Zed\Invoice\Persistence\FosInvoice $fosInvoice
     * @param \Generated\Shared\Transfer\InvoiceTransfer $invoiceTransfer
     *
     * @return \Generated\Shared\Transfer\InvoiceTransfer
     */
    public function mapEntityToTransfer(
        FosInvoice $fosInvoice,
        InvoiceTransfer $invoiceTransfer
    ): InvoiceTransfer;
}
