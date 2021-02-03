<?php

namespace FondOfOryx\Zed\ErporderPageSearch\Dependency\Service;

interface ErpOrderPageSearchToEventBehaviorFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\EventEntityTransfer[] $eventTransfers
     *
     * @return array
     */
    public function getEventTransferIds(array $eventTransfers): array;
}
