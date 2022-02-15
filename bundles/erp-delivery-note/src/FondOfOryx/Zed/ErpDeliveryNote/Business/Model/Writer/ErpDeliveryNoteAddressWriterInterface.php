<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Writer;

use Generated\Shared\Transfer\ErpDeliveryNoteAddressTransfer;

interface ErpDeliveryNoteAddressWriterInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteAddressTransfer $erpDeliveryNoteAddressTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteAddressTransfer
     */
    public function create(ErpDeliveryNoteAddressTransfer $erpDeliveryNoteAddressTransfer): ErpDeliveryNoteAddressTransfer;

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteAddressTransfer $erpDeliveryNoteAddressTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteAddressTransfer
     */
    public function update(ErpDeliveryNoteAddressTransfer $erpDeliveryNoteAddressTransfer): ErpDeliveryNoteAddressTransfer;

    /**
     * @param int $idErpDeliveryNoteAddress
     *
     * @return void
     */
    public function delete(int $idErpDeliveryNoteAddress): void;
}
