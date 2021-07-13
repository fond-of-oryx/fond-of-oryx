<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderProductType\Dependency\Facade;

use Generated\Shared\Transfer\JellyfishOrderItemTransfer;
use Generated\Shared\Transfer\ProductAbstractTransfer;
use Generated\Shared\Transfer\ProductConcreteTransfer;

interface JellyfishSalesOrderProductTypeToGiftCardFacadeInterface
{
    /**
     * @param int $idSalesOrderItem
     *
     * @return bool
     */
    public function isGiftCardOrderItem(int $idSalesOrderItem): bool;
}
