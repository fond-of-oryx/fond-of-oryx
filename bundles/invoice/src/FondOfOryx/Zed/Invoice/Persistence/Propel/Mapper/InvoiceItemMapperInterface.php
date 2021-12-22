<?php

namespace FondOfOryx\Zed\Invoice\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\ItemTransfer;
use Orm\Zed\Invoice\Persistence\FosInvoiceItem;

interface InvoiceItemMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     * @param \Orm\Zed\Invoice\Persistence\FosInvoiceItem $fosInvoiceItem
     *
     * @return \Orm\Zed\Invoice\Persistence\FosInvoiceItem
     */
    public function mapTransferToEntity(
        ItemTransfer $itemTransfer,
        FosInvoiceItem $fosInvoiceItem
    ): FosInvoiceItem;

    /**
     * @param \Orm\Zed\Invoice\Persistence\FosInvoiceItem $fosInvoiceItem
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     *
     * @return \Generated\Shared\Transfer\ItemTransfer
     */
    public function mapEntityToTransfer(
        FosInvoiceItem $fosInvoiceItem,
        ItemTransfer $itemTransfer
    ): ItemTransfer;
}
