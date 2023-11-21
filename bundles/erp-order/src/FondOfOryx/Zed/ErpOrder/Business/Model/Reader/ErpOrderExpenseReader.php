<?php

namespace FondOfOryx\Zed\ErpOrder\Business\Model\Reader;

use FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderRepositoryInterface;
use Generated\Shared\Transfer\ErpOrderExpenseCollectionTransfer;
use Generated\Shared\Transfer\ErpOrderExpenseTransfer;

class ErpOrderExpenseReader implements ErpOrderExpenseReaderInterface
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
     * @return \Generated\Shared\Transfer\ErpOrderExpenseCollectionTransfer
     */
    public function findErpOrderExpensesByIdErpOrder(int $idErpOrder): ErpOrderExpenseCollectionTransfer
    {
        return $this->repository->findErpOrderExpensesByIdErpOrder($idErpOrder);
    }

    /**
     * @param int $idErpOrderExpense
     *
     * @return \Generated\Shared\Transfer\ErpOrderExpenseTransfer|null
     */
    public function findErpOrderExpenseByIdErpOrderExpense(int $idErpOrderExpense): ?ErpOrderExpenseTransfer
    {
        return $this->repository->findErpOrderExpenseByIdErpOrderExpense($idErpOrderExpense);
    }
}
