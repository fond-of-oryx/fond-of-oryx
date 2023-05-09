<?php

namespace FondOfOryx\Zed\OrderBudgetSearchRestApi\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\OrderBudgetTransfer;

/**
 * @codeCoverageIgnore
 */
class OrderBudgetMapper implements OrderBudgetMapperInterface
{
    /**
     * @param int $id
     *
     * @return \Generated\Shared\Transfer\OrderBudgetTransfer
     */
    public function fromId(int $id): OrderBudgetTransfer
    {
        return (new OrderBudgetTransfer())->setIdOrderBudget($id);
    }

    /**
     * @param array<int> $ids
     *
     * @return array<\Generated\Shared\Transfer\OrderBudgetTransfer>
     */
    public function fromIds(array $ids): array
    {
        $orderBudgetTransfers = [];

        foreach ($ids as $id) {
            $orderBudgetTransfers[] = $this->fromId($id);
        }

        return $orderBudgetTransfers;
    }
}
