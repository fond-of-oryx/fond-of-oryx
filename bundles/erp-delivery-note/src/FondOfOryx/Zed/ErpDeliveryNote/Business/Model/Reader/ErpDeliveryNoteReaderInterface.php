<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Reader;

use Generated\Shared\Transfer\ErpDeliveryNoteTransfer;

interface ErpDeliveryNoteReaderInterface
{
    /**
     * @param int $idErpDeliveryNote
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteTransfer|null
     */
    public function findErpDeliveryNoteByIdErpDeliveryNote(int $idErpDeliveryNote): ?ErpDeliveryNoteTransfer;

    /**
     * @param string $erpDeliveryNoteExternalReference
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteTransfer|null
     */
    public function findErpDeliveryNoteByExternalReference(string $erpDeliveryNoteExternalReference): ?ErpDeliveryNoteTransfer;
}
