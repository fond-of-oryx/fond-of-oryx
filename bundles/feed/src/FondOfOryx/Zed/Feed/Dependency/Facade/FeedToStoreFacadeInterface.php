<?php

namespace FondOfOryx\Zed\Feed\Dependency\Facade;

use Generated\Shared\Transfer\StoreTransfer;

interface FeedToStoreFacadeInterface
{
    /**
     * @return \Generated\Shared\Transfer\StoreTransfer
     */
    public function getCurrentStore(): StoreTransfer;
}
