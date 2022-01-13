<?php

namespace FondOfOryx\Zed\StockProductApi\Persistence;

use Orm\Zed\Stock\Persistence\SpyStockProductQuery;

interface StockProductApiQueryContainerInterface
{
    /**
     * @return \Orm\Zed\Stock\Persistence\SpyStockProductQuery
     */
    public function queryFind(): SpyStockProductQuery;
}
