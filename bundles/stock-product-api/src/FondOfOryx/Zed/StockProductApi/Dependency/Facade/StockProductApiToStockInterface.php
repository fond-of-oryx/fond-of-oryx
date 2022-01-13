<?php

namespace FondOfOryx\Zed\StockProductApi\Dependency\Facade;

use Generated\Shared\Transfer\StockProductTransfer;

interface StockProductApiToStockInterface
{
    /**
     * @param \Generated\Shared\Transfer\StockProductTransfer $transferStockProduct
     *
     * @return int
     */
    public function createStockProduct(StockProductTransfer $transferStockProduct): int;

    /**
     * @param \Generated\Shared\Transfer\StockProductTransfer $stockProductTransfer
     *
     * @return int
     */
    public function updateStockProduct(StockProductTransfer $stockProductTransfer): int;

    /**
     * @param int $idProductConcrete
     *
     * @return array<\Generated\Shared\Transfer\StockProductTransfer>
     */
    public function getStockProductsByIdProduct(int $idProductConcrete): array;
}
