<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Reader;

use FondOfOryx\Zed\ErpDeliveryNote\Persistence\ErpDeliveryNoteRepositoryInterface;
use Generated\Shared\Transfer\ErpDeliveryNoteItemCollectionTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer;

class ErpDeliveryNoteItemReader implements ErpDeliveryNoteItemReaderInterface
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
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteItemCollectionTransfer
     */
    public function findErpDeliveryNoteItemsByIdErpDeliveryNote(int $idErpDeliveryNote): ErpDeliveryNoteItemCollectionTransfer
    {
        return $this->repository->findErpDeliveryNoteItemsByIdErpDeliveryNote($idErpDeliveryNote);
    }

    /**
     * @param int $idErpDeliveryNoteItem
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer|null
     */
    public function findErpDeliveryNoteItemByIdErpDeliveryNoteItem(int $idErpDeliveryNoteItem): ?ErpDeliveryNoteItemTransfer
    {
        return $this->repository->findErpDeliveryNoteItemByIdErpDeliveryNoteItem($idErpDeliveryNoteItem);
    }
}
