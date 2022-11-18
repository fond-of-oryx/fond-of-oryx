<?php

namespace FondOfOryx\Zed\ErpOrder\Business\Model\Reader;

use FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderRepositoryInterface;
use Generated\Shared\Transfer\ErpOrderItemCollectionTransfer;
use Generated\Shared\Transfer\ErpOrderItemTransfer;

class ErpOrderItemReader implements ErpOrderItemReaderInterface
{
    /**
     * @var \FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderRepositoryInterface
     */
    protected $repository;

    /**
     * @param \FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderRepositoryInterface $repository
     */
    public function __construct(ErpOrderRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $idErpOrder
     *
     * @return \Generated\Shared\Transfer\ErpOrderItemCollectionTransfer
     */
    public function findErpOrderItemsByIdErpOrder(int $idErpOrder): ErpOrderItemCollectionTransfer
    {
        return $this->repository->findErpOrderItemsByIdErpOrder($idErpOrder);
    }

    /**
     * @param int $idErpOrderItem
     *
     * @return \Generated\Shared\Transfer\ErpOrderItemTransfer|null
     */
    public function findErpOrderItemByIdErpOrderItem(int $idErpOrderItem): ?ErpOrderItemTransfer
    {
        return $this->repository->findErpOrderItemByIdErpOrderItem($idErpOrderItem);
    }
}
