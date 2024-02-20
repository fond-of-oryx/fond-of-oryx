<?php

namespace FondOfOryx\Zed\OrderBudget\Business\Reader;

interface OrderBudgetReaderInterface
{
    /**
     * @param array<int> $ids
     *
     * @return array<\Generated\Shared\Transfer\OrderBudgetTransfer>
     */
    public function getByIds(array $ids): array;

    /**
     * @return array<\Generated\Shared\Transfer\OrderBudgetTransfer>
     */
    public function getAll(): array;
}
