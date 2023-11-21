<?php

namespace FondOfOryx\Zed\ErpOrder\Business\PluginExecutor;

use Generated\Shared\Transfer\ErpOrderAmountTransfer;

interface ErpOrderAmountPluginExecutorInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpOrderAmountTransfer $erpOrderAmountTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderAmountTransfer
     */
    public function executePostSavePlugins(ErpOrderAmountTransfer $erpOrderAmountTransfer): ErpOrderAmountTransfer;

    /**
     * @param \Generated\Shared\Transfer\ErpOrderAmountTransfer $erpOrderAmountTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderAmountTransfer
     */
    public function executePreSavePlugins(ErpOrderAmountTransfer $erpOrderAmountTransfer): ErpOrderAmountTransfer;
}
