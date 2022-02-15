<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Reader;

use Generated\Shared\Transfer\ErpDeliveryNoteAddressTransfer;

interface ErpDeliveryNoteAddressReaderInterface
{
    /**
     * @param int $idErpDeliveryNoteAddress
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteAddressTransfer|null
     */
    public function findErpDeliveryNoteAddressByIdErpDeliveryNoteAddress(int $idErpDeliveryNoteAddress): ?ErpDeliveryNoteAddressTransfer;
}
