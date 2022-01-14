<?php

namespace FondOfOryx\Zed\StockApi\Persistence;

use Orm\Zed\Stock\Persistence\SpyStockQuery;

interface StockApiQueryContainerInterface
{
    /**
     * @return \Orm\Zed\Stock\Persistence\SpyStockQuery
     */
    public function queryFind(): SpyStockQuery;
}
