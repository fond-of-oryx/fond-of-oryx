<?php

namespace FondOfOryx\Zed\ProductListApi\Dependency\QueryContainer;

use Generated\Shared\Transfer\ApiCollectionTransfer;

interface ProductListApiToApiQueryContainerInterface
{
    /**
     * @param array $data
     *
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    public function createApiCollection(array $data): ApiCollectionTransfer;
}
