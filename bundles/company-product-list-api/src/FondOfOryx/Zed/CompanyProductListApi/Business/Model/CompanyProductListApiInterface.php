<?php

namespace FondOfOryx\Zed\CompanyProductListApi\Business\Model;

use Generated\Shared\Transfer\ApiDataTransfer;

interface CompanyProductListApiInterface
{
    /**
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function add(ApiDataTransfer $apiDataTransfer);
}
