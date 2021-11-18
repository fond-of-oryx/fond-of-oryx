<?php

namespace FondOfOryx\Zed\ErpInvoice\Business\Handler;

use Generated\Shared\Transfer\ErpInvoiceTransfer;

interface ErpInvoiceAddressHandlerInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceTransfer $erpInvoiceTransfer
     * @param string $addressType
     * @param \Generated\Shared\Transfer\ErpInvoiceTransfer|null $existingErpInvoiceTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceTransfer
     */
    public function handle(
        ErpInvoiceTransfer $erpInvoiceTransfer,
        string $addressType,
        ?ErpInvoiceTransfer $existingErpInvoiceTransfer = null
    ): ErpInvoiceTransfer;
}
