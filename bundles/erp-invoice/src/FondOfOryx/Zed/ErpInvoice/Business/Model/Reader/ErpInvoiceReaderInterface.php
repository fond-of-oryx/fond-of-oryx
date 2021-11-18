<?php

namespace FondOfOryx\Zed\ErpInvoice\Business\Model\Reader;

use Generated\Shared\Transfer\ErpInvoiceTransfer;

interface ErpInvoiceReaderInterface
{
    /**
     * @param int $idErpInvoice
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceTransfer|null
     */
    public function findErpInvoiceByIdErpInvoice(int $idErpInvoice): ?ErpInvoiceTransfer;

    /**
     * @param string $erpInvoiceExternalReference
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceTransfer|null
     */
    public function findErpInvoiceByExternalReference(string $erpInvoiceExternalReference): ?ErpInvoiceTransfer;
}
