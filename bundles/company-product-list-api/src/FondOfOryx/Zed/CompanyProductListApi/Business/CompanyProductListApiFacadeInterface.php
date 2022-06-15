<?php

namespace FondOfOryx\Zed\CompanyProductListApi\Business;

use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;

interface CompanyProductListApiFacadeInterface
{
    /**
     * Specification:
     *  - Adds new company product list relation.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function addCompanyProductList(ApiDataTransfer $apiDataTransfer): ApiItemTransfer;
}
