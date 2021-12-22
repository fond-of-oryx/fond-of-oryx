<?php

namespace FondOfOryx\Zed\Invoice\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\ItemTransfer;
use Orm\Zed\Invoice\Persistence\FooInvoiceItem;

class InvoiceItemMapper implements InvoiceItemMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     * @param \Orm\Zed\Invoice\Persistence\FooInvoiceItem $fooInvoiceItem
     *
     * @return \Orm\Zed\Invoice\Persistence\FooInvoiceItem
     */
    public function mapTransferToEntity(
        ItemTransfer $itemTransfer,
        FooInvoiceItem $fooInvoiceItem
    ): FooInvoiceItem {
        $fooInvoiceItem->fromArray(
            $itemTransfer->modifiedToArray(false),
        );

        return $fooInvoiceItem;
    }

    /**
     * @param \Orm\Zed\Invoice\Persistence\FooInvoiceItem $fooInvoiceItem
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     *
     * @return \Generated\Shared\Transfer\ItemTransfer
     */
    public function mapEntityToTransfer(
        FooInvoiceItem $fooInvoiceItem,
        ItemTransfer $itemTransfer
    ): ItemTransfer {
        return $itemTransfer->fromArray(
            $fooInvoiceItem->toArray(),
            true,
        );
    }
}
