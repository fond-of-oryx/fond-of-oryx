<?php

namespace FondOfOryx\Zed\JellyfishBufferGui\Persistence;

use FondOfOryx\Zed\JellyfishBufferGui\JellyfishBufferGuiDependencyProvider;
use Orm\Zed\JellyfishBuffer\Persistence\FooExportedOrderHistoryQuery;
use Orm\Zed\JellyfishBuffer\Persistence\FooExportedOrderQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfOryx\Zed\JellyfishBufferGui\JellyfishBufferGuiConfig getConfig()
 * @method \FondOfOryx\Zed\JellyfishBufferGui\Persistence\JellyfishBufferGuiQueryContainerInterface getQueryContainer()
 */
class JellyfishBufferGuiPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\JellyfishBuffer\Persistence\FooExportedOrderQuery
     */
    public function getExportedOrderQuery(): FooExportedOrderQuery
    {
        return $this->getProvidedDependency(JellyfishBufferGuiDependencyProvider::QUERY_EXPORTED_ORDER);
    }

    /**
     * @return \Orm\Zed\JellyfishBuffer\Persistence\FooExportedOrderHistoryQuery
     */
    public function getExportedOrderHistoryQuery(): FooExportedOrderHistoryQuery
    {
        return $this->getProvidedDependency(JellyfishBufferGuiDependencyProvider::QUERY_EXPORTED_ORDER_HISTORY);
    }
}
