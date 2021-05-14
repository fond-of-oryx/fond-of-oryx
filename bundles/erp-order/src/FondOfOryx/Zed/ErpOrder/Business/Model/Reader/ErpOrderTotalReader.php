<?php

namespace FondOfOryx\Zed\ErpOrder\Business\Model\Reader;

use FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderRepositoryInterface;
use Generated\Shared\Transfer\ErpOrderTotalTransfer;

class ErpOrderTotalReader implements ErpOrderTotalReaderInterface
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
     * @param int $idErpOrderTotal
     *
     * @return \Generated\Shared\Transfer\ErpOrderTotalTransfer|null
     */
    public function findErpOrderTotalByIdErpOrderTotal(int $idErpOrderTotal): ?ErpOrderTotalTransfer
    {
        return $this->repository->findErpOrderTotalByIdErpOrderTotal($idErpOrderTotal);
    }

    /**
     * @param int $idErpOrder
     *
     * @return \Generated\Shared\Transfer\ErpOrderTotalTransfer|null
     */
    public function findErpOrderTotalByIdErpOrder(int $idErpOrder): ?ErpOrderTotalTransfer
    {
        return $this->repository->findErpOrderTotalByIdErpOrder($idErpOrder);
    }
}
