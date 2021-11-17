<?php

namespace FondOfOryx\Zed\JellyfishSalesOrder\Persistence;

use FondOfOryx\Zed\JellyfishSalesOrder\JellyfishSalesOrderDependencyProvider;
use Orm\Zed\Oms\Persistence\Base\SpyOmsOrderItemStateQuery;
use Orm\Zed\Sales\Persistence\Base\SpySalesOrderQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfOryx\Zed\JellyfishSalesOrder\JellyfishSalesOrderConfig getConfig()
 * @method \FondOfOryx\Zed\JellyfishSalesOrder\Persistence\JellyfishSalesOrderQueryContainerInterface getQueryContainer()
 * @method \FondOfOryx\Zed\JellyfishSalesOrder\Persistence\JellyfishSalesOrderRepositoryInterface getRepository()
 */
class JellyfishSalesOrderPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\Oms\Persistence\Base\SpyOmsOrderItemStateQuery
     */
    public function getOmsOrderItemStateQuery(): SpyOmsOrderItemStateQuery
    {
        return $this->getProvidedDependency(JellyfishSalesOrderDependencyProvider::PROPEL_QUERY_OMS_ORDER_ITEM_STATE);
    }

    /**
     * @return \Orm\Zed\Sales\Persistence\Base\SpySalesOrderQuery
     */
    public function getSalesOrderQuery(): SpySalesOrderQuery
    {
        return $this->getProvidedDependency(JellyfishSalesOrderDependencyProvider::PROPEL_QUERY_SALES_ORDER);
    }
}
