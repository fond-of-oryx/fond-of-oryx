<?php

namespace FondOfOryx\Zed\JellyfishCreditMemo\Dependency\Facade;

use Generated\Shared\Transfer\OrderTransfer;

interface JellyfishCreditMemoToSalesFacadeInterface
{
    /**
     * @param int $idSalesOrder
     *
     * @return \Generated\Shared\Transfer\OrderTransfer|null
     */
    public function findOrderByIdSalesOrder(int $idSalesOrder): ?OrderTransfer;
}
