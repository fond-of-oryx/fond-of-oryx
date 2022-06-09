<?php

namespace FondOfOryx\Zed\CustomerProductListApi\Business\Model;

use Generated\Shared\Transfer\ApiDataTransfer;

interface CustomerProductListApiInterface
{
    /**
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function add(ApiDataTransfer $apiDataTransfer);
}
