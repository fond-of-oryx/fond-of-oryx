<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderPayone\Persistence;

use Orm\Zed\Payment\Persistence\SpySalesPaymentQuery;
use Orm\Zed\Payone\Persistence\SpyPaymentPayoneQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfOryx\Zed\JellyfishSalesOrderPayone\Persistence\JellyfishSalesOrderPayoneRepositoryInterface getRepository()()
 */
class JellyfishSalesOrderPayonePersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\Payment\Persistence\SpySalesPaymentQuery
     */
    public function createSalesPaymentQuery(): SpySalesPaymentQuery
    {
        return SpySalesPaymentQuery::create();
    }

    /**
     * @return \Orm\Zed\Payone\Persistence\SpyPaymentPayoneQuery
     */
    public function createPaymentPayoneQuery(): SpyPaymentPayoneQuery
    {
        return SpyPaymentPayoneQuery::create();
    }
}
