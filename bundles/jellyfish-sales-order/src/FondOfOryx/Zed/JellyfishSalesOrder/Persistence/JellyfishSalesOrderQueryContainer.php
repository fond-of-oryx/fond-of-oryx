<?php

namespace FondOfOryx\Zed\JellyfishSalesOrder\Persistence;

use Orm\Zed\Sales\Persistence\Base\SpySalesOrderQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use Spryker\Zed\Kernel\Persistence\AbstractQueryContainer;

/**
 * @method \FondOfOryx\Zed\JellyfishSalesOrder\Persistence\JellyfishSalesOrderPersistenceFactory getFactory()
 */
class JellyfishSalesOrderQueryContainer extends AbstractQueryContainer implements JellyfishSalesOrderQueryContainerInterface
{
    /**
     * @param int $idOmsOrderItemState
     *
     * @return \Orm\Zed\Sales\Persistence\Base\SpySalesOrderQuery
     */
    public function querySalesOrderByIdOmsOrderItemState(
        int $idOmsOrderItemState
    ): SpySalesOrderQuery {
        $minCreatedAtForOrders = $this->getFactory()
            ->getConfig()
            ->getMinCreatedAtForOrders();

        return $this->getFactory()
            ->getSalesOrderQuery()
            ->useItemQuery()
                ->useStateQuery()
                    ->filterByIdOmsOrderItemState($idOmsOrderItemState)
                ->endUse()
            ->endUse()
            ->filterByCreatedAt($minCreatedAtForOrders, Criteria::GREATER_EQUAL)
            ->groupByIdSalesOrder();
    }

    /**
     * @param int $idOmsOrderItemState
     * @param string $storeName
     *
     * @return \Orm\Zed\Sales\Persistence\Base\SpySalesOrderQuery
     */
    public function querySalesOrderByIdOmsOrderItemStateAndStoreName(
        int $idOmsOrderItemState,
        string $storeName
    ): SpySalesOrderQuery {
        return $this->querySalesOrderByIdOmsOrderItemState($idOmsOrderItemState)
            ->filterByStore($storeName);
    }
}
