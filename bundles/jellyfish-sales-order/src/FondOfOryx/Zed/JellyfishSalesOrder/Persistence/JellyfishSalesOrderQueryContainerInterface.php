<?php

namespace FondOfOryx\Zed\JellyfishSalesOrder\Persistence;

use Orm\Zed\Sales\Persistence\Base\SpySalesOrderQuery;

interface JellyfishSalesOrderQueryContainerInterface
{
    /**
     * @param int $idOmsOrderItemState
     *
     * @return \Orm\Zed\Sales\Persistence\Base\SpySalesOrderQuery
     */
    public function querySalesOrderByIdOmsOrderItemState(
        int $idOmsOrderItemState
    ): SpySalesOrderQuery;

    /**
     * @param int $idOmsOrderItemState
     * @param string $storeName
     *
     * @return \Orm\Zed\Sales\Persistence\Base\SpySalesOrderQuery
     */
    public function querySalesOrderByIdOmsOrderItemStateAndStoreName(
        int $idOmsOrderItemState,
        string $storeName
    ): SpySalesOrderQuery;
}
