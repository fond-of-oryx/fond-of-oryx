<?php

namespace FondOfOryx\Zed\ProductLocaleRestrictionStorage\Dependency\Facade;

interface ProductLocaleRestrictionStorageToEventBehaviorFacadeInterface
{
    /**
     * @param array<\Generated\Shared\Transfer\EventEntityTransfer> $eventTransfers
     *
     * @return array
     */
    public function getEventTransferIds(array $eventTransfers): array;

    /**
     * @param array<\Generated\Shared\Transfer\EventEntityTransfer> $eventTransfers
     * @param string $foreignKeyColumnName
     *
     * @return array
     */
    public function getEventTransferForeignKeys(array $eventTransfers, string $foreignKeyColumnName): array;
}
