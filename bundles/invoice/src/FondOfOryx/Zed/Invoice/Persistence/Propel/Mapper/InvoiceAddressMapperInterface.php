<?php

namespace FondOfOryx\Zed\Invoice\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\AddressTransfer;
use Orm\Zed\Invoice\Persistence\FosInvoiceAddress;

interface InvoiceAddressMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\AddressTransfer $addressTransfer
     * @param \Orm\Zed\Invoice\Persistence\FosInvoiceAddress $fosInvoiceAddress
     *
     * @return \Orm\Zed\Invoice\Persistence\FosInvoiceAddress
     */
    public function mapTransferToEntity(
        AddressTransfer $addressTransfer,
        FosInvoiceAddress $fosInvoiceAddress
    ): FosInvoiceAddress;
}
