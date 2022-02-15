<?php

namespace FondOfOryx\Zed\ErpDeliveryNoteApi\Dependency\Facade;

use FondOfOryx\Zed\ErpDeliveryNote\Business\ErpDeliveryNoteFacadeInterface;
use Generated\Shared\Transfer\ErpDeliveryNoteResponseTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteTransfer;

class ErpDeliveryNoteApiToErpDeliveryNoteFacadeBridge implements ErpDeliveryNoteApiToErpDeliveryNoteFacadeInterface
{
    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Business\ErpDeliveryNoteFacadeInterface
     */
    protected $erpDeliveryNoteFacade;

    /**
     * @param \FondOfOryx\Zed\ErpDeliveryNote\Business\ErpDeliveryNoteFacadeInterface $erpDeliveryNoteFacade
     */
    public function __construct(ErpDeliveryNoteFacadeInterface $erpDeliveryNoteFacade)
    {
        $this->erpDeliveryNoteFacade = $erpDeliveryNoteFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteResponseTransfer
     */
    public function createErpDeliveryNote(ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer): ErpDeliveryNoteResponseTransfer
    {
        return $this->erpDeliveryNoteFacade->createErpDeliveryNote($erpDeliveryNoteTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteResponseTransfer
     */
    public function updateErpDeliveryNote(ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer): ErpDeliveryNoteResponseTransfer
    {
        return $this->erpDeliveryNoteFacade->updateErpDeliveryNote($erpDeliveryNoteTransfer);
    }

    /**
     * @param int $idErpDeliveryNote
     *
     * @return void
     */
    public function deleteErpDeliveryNoteByIdErpDeliveryNote(int $idErpDeliveryNote): void
    {
        $this->erpDeliveryNoteFacade->deleteErpDeliveryNoteByIdErpDeliveryNote($idErpDeliveryNote);
    }

    /**
     * @param int $idErpDeliveryNote
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteTransfer|null
     */
    public function findErpDeliveryNoteByIdErpDeliveryNote(int $idErpDeliveryNote): ?ErpDeliveryNoteTransfer
    {
        return $this->erpDeliveryNoteFacade->findErpDeliveryNoteByIdErpDeliveryNote($idErpDeliveryNote);
    }
}
