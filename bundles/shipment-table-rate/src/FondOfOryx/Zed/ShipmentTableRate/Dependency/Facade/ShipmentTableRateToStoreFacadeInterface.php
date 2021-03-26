<?php

namespace FondOfOryx\Zed\ShipmentTableRate\Dependency\Facade;

use Generated\Shared\Transfer\StoreTransfer;

interface ShipmentTableRateToStoreFacadeInterface
{
    /**
     * @param string $storeName
     *
     * @return \Generated\Shared\Transfer\StoreTransfer
     */
    public function getStoreByName(string $storeName): StoreTransfer;
}
