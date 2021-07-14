<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderProductType\Dependency\Facade;

interface JellyfishSalesOrderProductTypeToGiftCardFacadeInterface
{
    /**
     * @param int $idSalesOrderItem
     *
     * @return bool
     */
    public function isGiftCardOrderItem(int $idSalesOrderItem): bool;
}
