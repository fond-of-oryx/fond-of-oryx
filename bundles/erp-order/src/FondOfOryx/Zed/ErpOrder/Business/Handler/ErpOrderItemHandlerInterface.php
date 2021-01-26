<?php

namespace FondOfOryx\Zed\ErpOrder\Business\Handler;

use Generated\Shared\Transfer\ErpOrderTransfer;

interface ErpOrderItemHandlerInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpOrderTransfer $erpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderTransfer
     */
    public function handle(ErpOrderTransfer $erpOrderTransfer): ErpOrderTransfer;
}
