<?php

namespace FondOfOryx\Zed\CreditMemoApi\Business\Model;

use Generated\Shared\Transfer\ApiDataTransfer;

interface CreditMemoApiInterface
{
    /**
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function add(ApiDataTransfer $apiDataTransfer);
}
