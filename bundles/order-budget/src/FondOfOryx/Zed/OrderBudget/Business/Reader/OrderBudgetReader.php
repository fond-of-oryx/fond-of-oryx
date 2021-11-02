<?php

namespace FondOfOryx\Zed\OrderBudget\Business\Reader;

use FondOfOryx\Zed\OrderBudget\Persistence\OrderBudgetRepositoryInterface;

class OrderBudgetReader implements OrderBudgetReaderInterface
{
    /**
     * @var \FondOfOryx\Zed\OrderBudget\Persistence\OrderBudgetRepositoryInterface
     */
    protected $repository;

    /**
     * @param \FondOfOryx\Zed\OrderBudget\Persistence\OrderBudgetRepositoryInterface $repository
     */
    public function __construct(OrderBudgetRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return array<\Generated\Shared\Transfer\OrderBudgetTransfer>
     */
    public function getAll(): array
    {
        return $this->repository->findAllOrderBudgets();
    }
}
