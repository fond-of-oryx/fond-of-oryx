<?php

namespace FondOfOryx\Zed\StockProductApi\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\StockProductTransfer;
use Orm\Zed\Stock\Persistence\SpyStockProduct;

interface MapperInterface
{
    /**
     * @param \Orm\Zed\Stock\Persistence\SpyStockProduct $spyStockProduct
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return \Generated\Shared\Transfer\StockProductTransfer
     */
    public function fromEntity(SpyStockProduct $spyStockProduct): StockProductTransfer;
}
