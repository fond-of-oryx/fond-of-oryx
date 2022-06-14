<?php

namespace FondOfOryx\Zed\ProductListApi\Business;

use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;

interface ProductListApiFacadeInterface
{
    /**
     * Specification:
     *  - Finds product lists by filter transfer, including sort, conditions and pagination.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    public function findProductLists(ApiRequestTransfer $apiRequestTransfer): ApiCollectionTransfer;
}
