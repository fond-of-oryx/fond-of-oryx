<?php

namespace FondOfOryx\Zed\ErpInvoicePageSearch\Persistence;

use Generated\Shared\Transfer\ErpInvoicePageSearchTransfer;

interface ErpInvoicePageSearchEntityManagerInterface
{
    /**
     * @param array $erpInvoiceIds
     *
     * @return void
     */
    public function deleteErpInvoiceSearchPagesByErpInvoiceIds(array $erpInvoiceIds): void;

    /**
     * @param \Generated\Shared\Transfer\ErpInvoicePageSearchTransfer $erpInvoicePageSearchTransfer
     *
     * @return void
     */
    public function persistErpInvoicePageSearch(ErpInvoicePageSearchTransfer $erpInvoicePageSearchTransfer): void;
}
