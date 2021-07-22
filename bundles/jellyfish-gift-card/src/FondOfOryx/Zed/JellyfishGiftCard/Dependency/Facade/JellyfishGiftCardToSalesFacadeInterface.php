<?php

namespace FondOfOryx\Zed\JellyfishGiftCard\Dependency\Facade;

use Generated\Shared\Transfer\OrderTransfer;

interface JellyfishGiftCardToSalesFacadeInterface
{
    /**
     * @param int $idSalesOrderItem
     *
     * @return \Generated\Shared\Transfer\OrderTransfer|null
     */
    public function findOrderByIdSalesOrderItem(int $idSalesOrderItem): ?OrderTransfer;
}
