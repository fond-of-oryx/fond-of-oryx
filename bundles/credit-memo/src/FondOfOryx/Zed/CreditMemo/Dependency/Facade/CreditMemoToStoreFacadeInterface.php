<?php

namespace FondOfOryx\Zed\CreditMemo\Dependency\Facade;

use Generated\Shared\Transfer\StoreTransfer;

interface CreditMemoToStoreFacadeInterface
{
    /**
     * @return \Generated\Shared\Transfer\StoreTransfer
     */
    public function getCurrentStore(): StoreTransfer;
}
