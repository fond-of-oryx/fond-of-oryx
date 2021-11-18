<?php

namespace FondOfOryx\Zed\ErpInvoiceApi\Dependency\Facade;

use Generated\Shared\Transfer\ErpInvoiceResponseTransfer;
use Generated\Shared\Transfer\ErpInvoiceTransfer;

interface ErpInvoiceApiToErpInvoiceFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceTransfer $erpInvoiceTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceResponseTransfer
     */
    public function createErpInvoice(ErpInvoiceTransfer $erpInvoiceTransfer): ErpInvoiceResponseTransfer;

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceTransfer $erpInvoiceTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceResponseTransfer
     */
    public function updateErpInvoice(ErpInvoiceTransfer $erpInvoiceTransfer): ErpInvoiceResponseTransfer;

    /**
     * @param int $idErpInvoice
     *
     * @return void
     */
    public function deleteErpInvoiceByIdErpInvoice(int $idErpInvoice): void;

    /**
     * @param int $idErpInvoice
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceTransfer|null
     */
    public function findErpInvoiceByIdErpInvoice(int $idErpInvoice): ?ErpInvoiceTransfer;
}
