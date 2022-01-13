<?php

namespace FondOfOryx\Zed\StockProductApi\Persistence;

use Generated\Shared\Transfer\StockProductTransfer;

interface StockProductApiRepositoryInterface
{
    /**
     * @param int $idStockProduct
     *
     * @return \Generated\Shared\Transfer\StockProductTransfer|null
     */
    public function getStockProductById(int $idStockProduct): ?StockProductTransfer;
}
