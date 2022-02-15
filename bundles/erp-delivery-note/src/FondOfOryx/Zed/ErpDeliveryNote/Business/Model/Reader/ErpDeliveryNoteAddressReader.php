<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Reader;

use FondOfOryx\Zed\ErpDeliveryNote\Persistence\ErpDeliveryNoteRepositoryInterface;
use Generated\Shared\Transfer\ErpDeliveryNoteAddressTransfer;

class ErpDeliveryNoteAddressReader implements ErpDeliveryNoteAddressReaderInterface
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
     * @param int $idErpDeliveryNoteAddress
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteAddressTransfer|null
     */
    public function findErpDeliveryNoteAddressByIdErpDeliveryNoteAddress(int $idErpDeliveryNoteAddress): ?ErpDeliveryNoteAddressTransfer
    {
        return $this->repository->findErpDeliveryNoteAddressByIdErpDeliveryNoteAddress($idErpDeliveryNoteAddress);
    }
}
