<?php

namespace FondOfOryx\Zed\ErpOrder\Business\PluginExecutor;

use Generated\Shared\Transfer\ErpOrderExpenseTransfer;

interface ErpOrderExpensePluginExecutorInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpOrderExpenseTransfer $erpOrderExpenseTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderExpenseTransfer
     */
    public function executePostSavePlugins(ErpOrderExpenseTransfer $erpOrderExpenseTransfer): ErpOrderExpenseTransfer;

    /**
     * @param \Generated\Shared\Transfer\ErpOrderExpenseTransfer $erpOrderExpenseTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderExpenseTransfer
     */
    public function executePreSavePlugins(ErpOrderExpenseTransfer $erpOrderExpenseTransfer): ErpOrderExpenseTransfer;
}
