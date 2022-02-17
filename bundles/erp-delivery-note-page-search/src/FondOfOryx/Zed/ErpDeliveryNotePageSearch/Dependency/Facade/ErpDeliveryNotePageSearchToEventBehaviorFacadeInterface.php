<?php

namespace FondOfOryx\Zed\ErpDeliveryNotePageSearch\Dependency\Facade;

interface ErpDeliveryNotePageSearchToEventBehaviorFacadeInterface
{
    /**
     * @param array<\Generated\Shared\Transfer\EventEntityTransfer> $eventTransfers
     *
     * @return array
     */
    public function getEventTransferIds(array $eventTransfers): array;
}
