<?php

namespace FondOfOryx\Zed\Invoice\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\InvoiceTransfer;
use Orm\Zed\Invoice\Persistence\FooInvoice;

class InvoiceMapper implements InvoiceMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\InvoiceTransfer $invoiceTransfer
     * @param \Orm\Zed\Invoice\Persistence\FooInvoice $fooInvoice
     *
     * @return \Orm\Zed\Invoice\Persistence\FooInvoice
     */
    public function mapTransferToEntity(
        InvoiceTransfer $invoiceTransfer,
        FooInvoice $fooInvoice
    ): FooInvoice {
        $fooInvoice->fromArray(
            $invoiceTransfer->modifiedToArray(false),
        );

        $addressTransfer = $invoiceTransfer->getAddress();

        if ($addressTransfer !== null && $addressTransfer->getIdInvoiceAddress() !== null) {
            $fooInvoice->setFkInvoiceAddress(
                $addressTransfer->getIdInvoiceAddress(),
            );
        }

        return $fooInvoice;
    }

    /**
     * @param \Orm\Zed\Invoice\Persistence\FooInvoice $fooInvoice
     * @param \Generated\Shared\Transfer\InvoiceTransfer $invoiceTransfer
     *
     * @return \Generated\Shared\Transfer\InvoiceTransfer
     */
    public function mapEntityToTransfer(
        FooInvoice $fooInvoice,
        InvoiceTransfer $invoiceTransfer
    ): InvoiceTransfer {
        return $invoiceTransfer->fromArray($fooInvoice->toArray(), true);
    }
}
