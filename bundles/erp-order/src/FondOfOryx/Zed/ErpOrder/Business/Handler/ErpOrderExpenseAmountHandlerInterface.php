<?php

namespace FondOfOryx\Zed\ErpOrder\Business\Handler;

use Generated\Shared\Transfer\ErpOrderExpenseTransfer;
use Generated\Shared\Transfer\ErpOrderTransfer;

interface ErpOrderExpenseAmountHandlerInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpOrderExpenseTransfer $erpOrderExpenseTransfer
     * @param \Generated\Shared\Transfer\ErpOrderTransfer|null $existingErpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderExpenseTransfer
     */
    public function handle(
        ErpOrderExpenseTransfer $erpOrderExpenseTransfer,
        ?ErpOrderTransfer $existingErpOrderTransfer = null
    ): ErpOrderExpenseTransfer;
}
