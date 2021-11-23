<?php

namespace FondOfOryx\Zed\ErpInvoicePageSearch\Dependency\Facade;

interface ErpInvoicePageSearchToEventBehaviorFacadeInterface
{
    /**
     * @param array<\Generated\Shared\Transfer\EventEntityTransfer> $eventTransfers
     *
     * @return array
     */
    public function getEventTransferIds(array $eventTransfers): array;
}
