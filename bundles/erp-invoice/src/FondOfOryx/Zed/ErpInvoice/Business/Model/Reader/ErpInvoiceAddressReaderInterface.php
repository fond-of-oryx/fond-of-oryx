<?php

namespace FondOfOryx\Zed\ErpInvoice\Business\Model\Reader;

use Generated\Shared\Transfer\ErpInvoiceAddressTransfer;

interface ErpInvoiceAddressReaderInterface
{
    /**
     * @param int $idErpInvoiceAddress
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceAddressTransfer|null
     */
    public function findErpInvoiceAddressByIdErpInvoiceAddress(int $idErpInvoiceAddress): ?ErpInvoiceAddressTransfer;
}
