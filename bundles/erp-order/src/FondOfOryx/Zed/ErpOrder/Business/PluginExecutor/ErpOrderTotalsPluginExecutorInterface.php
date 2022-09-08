<?php

namespace FondOfOryx\Zed\ErpOrder\Business\PluginExecutor;

use Generated\Shared\Transfer\ErpOrderTotalsTransfer;

interface ErpOrderTotalsPluginExecutorInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpOrderTotalsTransfer $erpOrderTotalsTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderTotalsTransfer
     */
    public function executePostSavePlugins(ErpOrderTotalsTransfer $erpOrderTotalsTransfer): ErpOrderTotalsTransfer;

    /**
     * @param \Generated\Shared\Transfer\ErpOrderTotalsTransfer $erpOrderTotalsTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderTotalsTransfer
     */
    public function executePreSavePlugins(ErpOrderTotalsTransfer $erpOrderTotalsTransfer): ErpOrderTotalsTransfer;
}
