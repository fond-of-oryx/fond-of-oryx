<?php

namespace FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\Dependency\Facade;

use Generated\Shared\Transfer\StoreTransfer;

interface JellyfishAvailabilityAlertToStoreFacadeInterface
{
    /**
     * @return \Generated\Shared\Transfer\StoreTransfer
     */
    public function getCurrentStore(): StoreTransfer;
}
