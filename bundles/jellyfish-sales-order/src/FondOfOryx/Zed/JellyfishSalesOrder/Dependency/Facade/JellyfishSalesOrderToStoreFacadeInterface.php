<?php

namespace FondOfOryx\Zed\JellyfishSalesOrder\Dependency\Facade;

use Generated\Shared\Transfer\StoreTransfer;

interface JellyfishSalesOrderToStoreFacadeInterface
{
    /**
     * @return \Generated\Shared\Transfer\StoreTransfer
     */
    public function getCurrentStore(): StoreTransfer;
}
