<?php

namespace FondOfOryx\Zed\OrderBudget\Business\Reader;

interface OrderBudgetReaderInterface
{
    /**
     * @return array<\Generated\Shared\Transfer\OrderBudgetTransfer>
     */
    public function getAll(): array;
}
