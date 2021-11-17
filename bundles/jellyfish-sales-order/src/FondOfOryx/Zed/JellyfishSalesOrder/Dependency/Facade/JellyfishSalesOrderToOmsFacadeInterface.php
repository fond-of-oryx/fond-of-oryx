<?php

namespace FondOfOryx\Zed\JellyfishSalesOrder\Dependency\Facade;

use Propel\Runtime\Collection\ObjectCollection;

interface JellyfishSalesOrderToOmsFacadeInterface
{
    /**
     * @param string $eventId
     * @param \Propel\Runtime\Collection\ObjectCollection $orderItems
     * @param array $logContext
     * @param array $data
     *
     * @return array|null
     */
    public function triggerEvent(
        string $eventId,
        ObjectCollection $orderItems,
        array $logContext,
        array $data = []
    ): ?array;
}
