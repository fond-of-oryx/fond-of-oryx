<?php

namespace FondOfOryx\Zed\CompanyTypeProductListsRestApi\Business;

use Generated\Shared\Transfer\RestProductListUpdateRequestTransfer;

interface CompanyTypeProductListsRestApiFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestProductListUpdateRequestTransfer $restProductListUpdateRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestProductListUpdateRequestTransfer
     */
    public function expandRestProductListUpdateRequest(
        RestProductListUpdateRequestTransfer $restProductListUpdateRequestTransfer
    ): RestProductListUpdateRequestTransfer;
}
