<?php

namespace FondOfOryx\Zed\ErpOrder\Business\Handler;

use Generated\Shared\Transfer\ErpOrderItemTransfer;
use Generated\Shared\Transfer\ErpOrderTransfer;

interface ErpOrderItemAmountHandlerInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpOrderItemTransfer $erpOrderItemTransfer
     * @param \Generated\Shared\Transfer\ErpOrderTransfer|null $existingErpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderItemTransfer
     */
    public function handle(ErpOrderItemTransfer $erpOrderItemTransfer, ?ErpOrderTransfer $existingErpOrderTransfer = null): ErpOrderItemTransfer;
}
