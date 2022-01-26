<?php

namespace FondOfOryx\Zed\JellyfishBufferGui\Persistence;

use Orm\Zed\JellyfishBuffer\Persistence\FooExportedOrderHistoryQuery;
use Orm\Zed\JellyfishBuffer\Persistence\FooExportedOrderQuery;
use Spryker\Zed\Kernel\Persistence\AbstractQueryContainer;

/**
 * @method \FondOfOryx\Zed\JellyfishBufferGui\Persistence\JellyfishBufferGuiPersistenceFactory getFactory()
 */
class JellyfishBufferGuiQueryContainer extends AbstractQueryContainer implements JellyfishBufferGuiQueryContainerInterface
{
    /**
     * @param string $storeName
     *
     * @return \Orm\Zed\JellyfishBuffer\Persistence\FooExportedOrderQuery
     */
    public function getExportedOrderQuery(string $storeName): FooExportedOrderQuery
    {
        $query = new FooExportedOrderQuery();
        $query->filterByStore($storeName);
        $query->joinWithOrder();

        return $query;
    }

    /**
     * @return \Orm\Zed\JellyfishBuffer\Persistence\FooExportedOrderHistoryQuery
     */
    public function getExportedOrderHistoryQuery(): FooExportedOrderHistoryQuery
    {
        $query = $this->getFactory()->getExportedOrderHistoryQuery();
        $query->joinWithSpyUser();

        return $query;
    }
}
