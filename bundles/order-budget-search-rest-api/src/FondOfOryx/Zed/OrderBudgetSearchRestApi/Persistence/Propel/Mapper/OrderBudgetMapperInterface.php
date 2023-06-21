<?php

namespace FondOfOryx\Zed\OrderBudgetSearchRestApi\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\OrderBudgetTransfer;

interface OrderBudgetMapperInterface
{
    /**
     * @param int $id
     *
     * @return \Generated\Shared\Transfer\OrderBudgetTransfer
     */
    public function fromId(int $id): OrderBudgetTransfer;

    /**
     * @param array<int> $ids
     *
     * @return array<\Generated\Shared\Transfer\OrderBudgetTransfer>
     */
    public function fromIds(array $ids): array;
}
