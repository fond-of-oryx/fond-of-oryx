<?php

namespace FondOfOryx\Zed\Invoice\Persistence;

use Generated\Shared\Transfer\ItemTransfer;

interface InvoiceRepositoryInterface
{
    /**
     * @param int $idSalesOrderItem
     *
     * @return \Generated\Shared\Transfer\ItemTransfer|null
     */
    public function findInvoiceItemByIdSalesOrderItem(int $idSalesOrderItem): ?ItemTransfer;
}
