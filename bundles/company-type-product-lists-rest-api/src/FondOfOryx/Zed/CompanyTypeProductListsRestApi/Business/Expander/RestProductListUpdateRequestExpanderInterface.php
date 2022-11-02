<?php

namespace FondOfOryx\Zed\CompanyTypeProductListsRestApi\Business\Expander;

use Generated\Shared\Transfer\RestProductListUpdateRequestTransfer;

interface RestProductListUpdateRequestExpanderInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestProductListUpdateRequestTransfer $restProductListUpdateRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestProductListUpdateRequestTransfer
     */
    public function expand(
        RestProductListUpdateRequestTransfer $restProductListUpdateRequestTransfer
    ): RestProductListUpdateRequestTransfer;
}
