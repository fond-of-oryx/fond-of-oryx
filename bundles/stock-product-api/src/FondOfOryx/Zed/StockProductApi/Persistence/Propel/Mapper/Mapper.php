<?php

namespace FondOfOryx\Zed\StockProductApi\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\StockProductTransfer;
use Orm\Zed\Stock\Persistence\SpyStockProduct;

class Mapper implements MapperInterface
{
    /**
     * @param \Orm\Zed\Stock\Persistence\SpyStockProduct $spyStockProduct
     *
     * @return \Generated\Shared\Transfer\StockProductTransfer
     */
    public function fromEntity(SpyStockProduct $spyStockProduct): StockProductTransfer
    {
        $transfer = (new StockProductTransfer())->fromArray($spyStockProduct->toArray(), true);
        $transfer = $this->mapProductData($transfer, $spyStockProduct);
        $transfer = $this->mapStockData($transfer, $spyStockProduct);

        return $transfer;
    }

    /**
     * @param \Generated\Shared\Transfer\StockProductTransfer $stockProductTransfer
     * @param \Orm\Zed\Stock\Persistence\SpyStockProduct $spyStockProduct
     *
     * @return \Generated\Shared\Transfer\StockProductTransfer
     */
    protected function mapProductData(StockProductTransfer $stockProductTransfer, SpyStockProduct $spyStockProduct)
    {
        $product = $spyStockProduct->getSpyProduct();
        // @phpstan-ignore-next-line
        if ($product === null) {
            return $stockProductTransfer;
        }

        return $stockProductTransfer->setSku($product->getSku());
    }

    /**
     * @param \Generated\Shared\Transfer\StockProductTransfer $stockProductTransfer
     * @param \Orm\Zed\Stock\Persistence\SpyStockProduct $spyStockProduct
     *
     * @return \Generated\Shared\Transfer\StockProductTransfer
     */
    protected function mapStockData(StockProductTransfer $stockProductTransfer, SpyStockProduct $spyStockProduct)
    {
        $stock = $spyStockProduct->getStock();
        // @phpstan-ignore-next-line
        if ($stock === null) {
            return $stockProductTransfer;
        }

        return $stockProductTransfer->setStockType($stock->getName());
    }
}
