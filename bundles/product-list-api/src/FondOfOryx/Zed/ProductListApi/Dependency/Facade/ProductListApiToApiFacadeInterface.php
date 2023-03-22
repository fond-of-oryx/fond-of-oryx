<?php

namespace FondOfOryx\Zed\ProductListApi\Dependency\Facade;

use Generated\Shared\Transfer\ApiCollectionTransfer;

interface ProductListApiToApiFacadeInterface
{
    /**
     * @param array<\Spryker\Shared\Kernel\Transfer\AbstractTransfer> $transfers
     *
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    public function createApiCollection(array $transfers): ApiCollectionTransfer;
}
