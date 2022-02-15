<?php

namespace FondOfOryx\Zed\ErpDeliveryNoteApi\Dependency\Facade;

use Generated\Shared\Transfer\ErpDeliveryNoteResponseTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteTransfer;

interface ErpDeliveryNoteApiToErpDeliveryNoteFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteResponseTransfer
     */
    public function createErpDeliveryNote(ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer): ErpDeliveryNoteResponseTransfer;

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteResponseTransfer
     */
    public function updateErpDeliveryNote(ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer): ErpDeliveryNoteResponseTransfer;

    /**
     * @param int $idErpDeliveryNote
     *
     * @return void
     */
    public function deleteErpDeliveryNoteByIdErpDeliveryNote(int $idErpDeliveryNote): void;

    /**
     * @param int $idErpDeliveryNote
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteTransfer|null
     */
    public function findErpDeliveryNoteByIdErpDeliveryNote(int $idErpDeliveryNote): ?ErpDeliveryNoteTransfer;
}
