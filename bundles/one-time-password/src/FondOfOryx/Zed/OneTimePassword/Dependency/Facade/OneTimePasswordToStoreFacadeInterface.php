<?php

namespace FondOfOryx\Zed\OneTimePassword\Dependency\Facade;

use Generated\Shared\Transfer\StoreTransfer;

interface OneTimePasswordToStoreFacadeInterface
{
    /**
     * @return \Generated\Shared\Transfer\StoreTransfer
     */
    public function getCurrentStore(): StoreTransfer;
}
