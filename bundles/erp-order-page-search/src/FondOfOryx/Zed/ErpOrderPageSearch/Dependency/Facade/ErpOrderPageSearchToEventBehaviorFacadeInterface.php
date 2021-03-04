<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch\Dependency\Facade;

interface ErpOrderPageSearchToEventBehaviorFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\EventEntityTransfer[] $eventTransfers
     *
     * @return array
     */
    public function getEventTransferIds(array $eventTransfers): array;
}
