<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade;

use Generated\Shared\Transfer\StoreTransfer;

interface AvailabilityAlertToStoreInterface
{
    /**
     * @param string $store
     *
     * @return \Generated\Shared\Transfer\StoreTransfer
     */
    public function getStore(string $store): StoreTransfer;
}
