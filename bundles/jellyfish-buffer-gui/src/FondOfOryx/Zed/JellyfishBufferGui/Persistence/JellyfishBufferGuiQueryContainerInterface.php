<?php

namespace FondOfOryx\Zed\JellyfishBufferGui\Persistence;

use Orm\Zed\JellyfishBuffer\Persistence\FooExportedOrderHistoryQuery;
use Orm\Zed\JellyfishBuffer\Persistence\FooExportedOrderQuery;

interface JellyfishBufferGuiQueryContainerInterface
{
    /**
     * @param string $storeName
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     *
     * @return \Orm\Zed\JellyfishBuffer\Persistence\FooExportedOrderQuery
     */
    public function getExportedOrderQuery(string $storeName): FooExportedOrderQuery;

    /**
     * @return \Orm\Zed\JellyfishBuffer\Persistence\FooExportedOrderHistoryQuery
     */
    public function getExportedOrderHistoryQuery(): FooExportedOrderHistoryQuery;
}
