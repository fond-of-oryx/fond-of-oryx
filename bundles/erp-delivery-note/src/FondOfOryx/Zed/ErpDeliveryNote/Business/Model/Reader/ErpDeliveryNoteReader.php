<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Reader;

use FondOfOryx\Zed\ErpDeliveryNote\Persistence\ErpDeliveryNoteRepositoryInterface;
use Generated\Shared\Transfer\ErpDeliveryNoteTransfer;

class ErpDeliveryNoteReader implements ErpDeliveryNoteReaderInterface
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
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteTransfer|null
     */
    public function findErpDeliveryNoteByIdErpDeliveryNote(int $idErpDeliveryNote): ?ErpDeliveryNoteTransfer
    {
        return $this->repository->findErpDeliveryNoteByIdErpDeliveryNote($idErpDeliveryNote);
    }

    /**
     * @param string $erpDeliveryNoteExternalReference
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteTransfer|null
     */
    public function findErpDeliveryNoteByExternalReference(string $erpDeliveryNoteExternalReference): ?ErpDeliveryNoteTransfer
    {
        return $this->repository->findErpDeliveryNoteByExternalReference($erpDeliveryNoteExternalReference);
    }
}
