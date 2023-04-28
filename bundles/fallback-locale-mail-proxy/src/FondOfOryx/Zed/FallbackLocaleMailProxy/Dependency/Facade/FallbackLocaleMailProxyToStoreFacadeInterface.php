<?php

namespace FondOfOryx\Zed\FallbackLocaleMailProxy\Dependency\Facade;

use Generated\Shared\Transfer\StoreTransfer;

interface FallbackLocaleMailProxyToStoreFacadeInterface
{
    /**
     * @param string $storeName
     *
     * @return \Generated\Shared\Transfer\StoreTransfer
     */
    public function getStoreByName(string $storeName): StoreTransfer;

    /**
     * @return \Generated\Shared\Transfer\StoreTransfer
     */
    public function getCurrentStore(): StoreTransfer;
}
