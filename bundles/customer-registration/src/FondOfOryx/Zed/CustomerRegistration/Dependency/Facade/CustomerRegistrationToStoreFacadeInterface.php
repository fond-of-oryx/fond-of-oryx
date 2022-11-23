<?php

namespace FondOfOryx\Zed\CustomerRegistration\Dependency\Facade;

use Generated\Shared\Transfer\StoreTransfer;

interface CustomerRegistrationToStoreFacadeInterface
{
    /**
     * @return \Generated\Shared\Transfer\StoreTransfer
     */
    public function getCurrentStore(): StoreTransfer;
}
