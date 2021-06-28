<?php

namespace FondOfOryx\Zed\JellyfishCreditMemo\Persistence;

use FondOfOryx\Zed\JellyfishCreditMemo\JellyfishCreditMemoDependencyProvider;
use Orm\Zed\CreditMemo\Persistence\FooCreditMemoQuery;
use Orm\Zed\Sales\Persistence\SpySalesOrderItemQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfOryx\Zed\JellyfishCreditMemo\Persistence\JellyfishCreditMemoRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\JellyfishCreditMemo\Persistence\JellyfishCreditMemoEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\JellyfishCreditMemo\JellyfishCreditMemoConfig getConfig()
 */
class JellyfishCreditMemoPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\CreditMemo\Persistence\FooCreditMemoQuery
     */
    public function createCreditMemoQuery(): FooCreditMemoQuery
    {
        return FooCreditMemoQuery::create();
    }

    /**
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderItemQuery
     */
    public function getSalesOrderItemQuery(): SpySalesOrderItemQuery
    {
        return $this->getProvidedDependency(JellyfishCreditMemoDependencyProvider::PROPEL_QUERY_SALES_ORDER_ITEM);
    }
}
