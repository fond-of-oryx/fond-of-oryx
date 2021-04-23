<?php

namespace FondOfOryx\Yves\AvailabilityAlert\Dependency\Client;

use Generated\Shared\Transfer\StoreTransfer;

interface AvailabilityAlertToStoreClientInterface
{
    /**
     * @return \Generated\Shared\Transfer\StoreTransfer
     */
    public function getCurrentStore(): StoreTransfer;
}
