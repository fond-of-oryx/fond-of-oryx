<?php

namespace FondOfOryx\Zed\Invoice\Dependency\Facade;

use Generated\Shared\Transfer\StoreTransfer;

interface InvoiceToStoreFacadeInterface
{
    /**
     * @return \Generated\Shared\Transfer\StoreTransfer
     */
    public function getCurrentStore(): StoreTransfer;
}
