<?php

namespace FondOfOryx\Zed\ErpInvoice\Business\Model\Reader;

use Generated\Shared\Transfer\ErpInvoiceItemCollectionTransfer;
use Generated\Shared\Transfer\ErpInvoiceItemTransfer;

interface ErpInvoiceItemReaderInterface
{
    /**
     * @param int $idErpInvoiceItem
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceItemTransfer|null
     */
    public function findErpInvoiceItemByIdErpInvoiceItem(int $idErpInvoiceItem): ?ErpInvoiceItemTransfer;

    /**
     * @param int $idErpInvoice
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceItemCollectionTransfer
     */
    public function findErpInvoiceItemsByIdErpInvoice(int $idErpInvoice): ErpInvoiceItemCollectionTransfer;
}
