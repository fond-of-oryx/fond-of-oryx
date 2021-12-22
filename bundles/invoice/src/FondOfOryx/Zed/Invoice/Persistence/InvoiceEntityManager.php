<?php

namespace FondOfOryx\Zed\Invoice\Persistence;

use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\InvoiceTransfer;
use Generated\Shared\Transfer\ItemTransfer;
use Orm\Zed\Invoice\Persistence\FooInvoice;
use Orm\Zed\Invoice\Persistence\FooInvoiceAddress;
use Orm\Zed\Invoice\Persistence\FooInvoiceItem;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \FondOfOryx\Zed\Invoice\Persistence\InvoicePersistenceFactory getFactory()
 */
class InvoiceEntityManager extends AbstractEntityManager implements InvoiceEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\InvoiceTransfer $invoiceTransfer
     *
     * @return \Generated\Shared\Transfer\InvoiceTransfer
     */
    public function createInvoice(
        InvoiceTransfer $invoiceTransfer
    ): InvoiceTransfer {
        $fooInvoice = $this->getFactory()
            ->createInvoiceMapper()
            ->mapTransferToEntity($invoiceTransfer, new FooInvoice());

        $fooInvoice->save();

        return $invoiceTransfer->setIdInvoice(
            $fooInvoice->getIdInvoice(),
        );
    }

    /**
     * @param \Generated\Shared\Transfer\AddressTransfer $addressTransfer
     *
     * @return \Generated\Shared\Transfer\AddressTransfer
     */
    public function createInvoiceAddress(
        AddressTransfer $addressTransfer
    ): AddressTransfer {
        $fooInvoiceAddress = $this->getFactory()
            ->createInvoiceAddressMapper()
            ->mapTransferToEntity($addressTransfer, new FooInvoiceAddress());

        $fooInvoiceAddress->save();

        return $addressTransfer->setIdInvoiceAddress(
            $fooInvoiceAddress->getIdInvoiceAddress(),
        );
    }

    /**
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     *
     * @return \Generated\Shared\Transfer\ItemTransfer
     */
    public function createInvoiceItem(ItemTransfer $itemTransfer): ItemTransfer
    {
        $fooInvoiceItem = $this->getFactory()
            ->createInvoiceItemMapper()
            ->mapTransferToEntity($itemTransfer, new FooInvoiceItem());

        $fooInvoiceItem->save();

        return $itemTransfer->setIdInvoiceItem(
            $fooInvoiceItem->getIdInvoiceItem(),
        );
    }
}
