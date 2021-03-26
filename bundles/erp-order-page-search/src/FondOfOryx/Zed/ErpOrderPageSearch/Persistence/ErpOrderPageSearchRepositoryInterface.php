<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch\Persistence;

use Generated\Shared\Transfer\FilterTransfer;

interface ErpOrderPageSearchRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\FilterTransfer $filterTransfer
     * @param int[] $erpOrderIds
     *
     * @return \Generated\Shared\Transfer\FooErpOrderPageSearchEntityTransfer[]
     */
    public function findFilteredErpOrderPageSearchEntities(
        FilterTransfer $filterTransfer,
        array $erpOrderIds = []
    ): array;
}
