<?php

namespace FondOfOryx\Zed\CustomerProductListApi\Business;

use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;

interface CustomerProductListApiFacadeInterface
{
    /**
     * Specification:
     *  - Adds new customer product list relation.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function addCustomerProductList(ApiDataTransfer $apiDataTransfer): ApiItemTransfer;
}
