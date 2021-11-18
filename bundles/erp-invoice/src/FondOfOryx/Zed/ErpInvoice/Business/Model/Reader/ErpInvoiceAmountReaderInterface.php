<?php

namespace FondOfOryx\Zed\ErpInvoice\Business\Model\Reader;

use Generated\Shared\Transfer\ErpInvoiceAmountTransfer;

interface ErpInvoiceAmountReaderInterface
{
    /**
     * @param int $idErpInvoiceAmount
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceAmountTransfer|null
     */
    public function findErpInvoiceAmountByIdErpInvoiceAmount(int $idErpInvoiceAmount): ?ErpInvoiceAmountTransfer;
}
