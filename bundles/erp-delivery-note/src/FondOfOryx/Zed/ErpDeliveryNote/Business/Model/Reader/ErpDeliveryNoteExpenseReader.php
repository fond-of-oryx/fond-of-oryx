<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Reader;

use FondOfOryx\Zed\ErpDeliveryNote\Persistence\ErpDeliveryNoteRepositoryInterface;
use Generated\Shared\Transfer\ErpDeliveryNoteExpenseCollectionTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteExpenseTransfer;

class ErpDeliveryNoteExpenseReader implements ErpDeliveryNoteExpenseReaderInterface
{
    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Persistence\ErpDeliveryNoteRepositoryInterface
     */
    protected $repository;

    /**
     * @param \FondOfOryx\Zed\ErpDeliveryNote\Persistence\ErpDeliveryNoteRepositoryInterface $repository
     */
    public function __construct(ErpDeliveryNoteRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $idErpDeliveryNote
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteExpenseCollectionTransfer
     */
    public function findErpDeliveryNoteExpensesByIdErpDeliveryNote(int $idErpDeliveryNote): ErpDeliveryNoteExpenseCollectionTransfer
    {
        return $this->repository->findErpDeliveryNoteExpensesByIdErpDeliveryNote($idErpDeliveryNote);
    }

    /**
     * @param int $idErpDeliveryNoteExpense
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteExpenseTransfer|null
     */
    public function findErpDeliveryNoteExpenseByIdErpDeliveryNoteExpense(int $idErpDeliveryNoteExpense): ?ErpDeliveryNoteExpenseTransfer
    {
        return $this->repository->findErpDeliveryNoteExpenseByIdErpDeliveryNoteExpense($idErpDeliveryNoteExpense);
    }
}
