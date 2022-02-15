<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Writer;

use Generated\Shared\Transfer\ErpDeliveryNoteResponseTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteTransfer;

interface ErpDeliveryNoteWriterInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteResponseTransfer
     */
    public function create(ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer): ErpDeliveryNoteResponseTransfer;

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteResponseTransfer
     */
    public function update(ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer): ErpDeliveryNoteResponseTransfer;

    /**
     * @param int $idErpDeliveryNote
     *
     * @return void
     */
    public function delete(int $idErpDeliveryNote): void;
}
