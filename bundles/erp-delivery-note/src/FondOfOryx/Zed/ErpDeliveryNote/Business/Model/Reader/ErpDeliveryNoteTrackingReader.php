<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Reader;

use FondOfOryx\Zed\ErpDeliveryNote\Persistence\ErpDeliveryNoteRepositoryInterface;
use Generated\Shared\Transfer\ErpDeliveryNoteTrackingCollectionTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteTrackingTransfer;

class ErpDeliveryNoteTrackingReader implements ErpDeliveryNoteTrackingReaderInterface
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
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteTrackingCollectionTransfer
     */
    public function findErpDeliveryNoteTrackingByIdErpDeliveryNote(int $idErpDeliveryNote): ErpDeliveryNoteTrackingCollectionTransfer
    {
        return $this->repository->findErpDeliveryNoteTrackingByIdErpDeliveryNote($idErpDeliveryNote);
    }

    /**
     * @param int $idErpDeliveryNoteTracking
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteTrackingTransfer|null
     */
    public function findErpDeliveryNoteTrackingByIdErpDeliveryNoteTracking(int $idErpDeliveryNoteTracking): ?ErpDeliveryNoteTrackingTransfer
    {
        return $this->repository->findErpDeliveryNoteTrackingByIdErpDeliveryNoteTracking($idErpDeliveryNoteTracking);
    }
}
