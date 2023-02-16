<?php

namespace FondOfOryx\Zed\CustomerApi\Persistence;

use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;

interface CustomerApiRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    public function findCustomersByApiRequest(ApiRequestTransfer $apiRequestTransfer): ApiCollectionTransfer;
}
