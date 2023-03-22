<?php

namespace FondOfOryx\Zed\ErpOrder\Business\PluginExecutor;

use Generated\Shared\Transfer\ErpOrderTotalTransfer;

interface ErpOrderTotalPluginExecutorInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpOrderTotalTransfer $erpOrderTotalTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderTotalTransfer
     */
    public function executePostSavePlugins(ErpOrderTotalTransfer $erpOrderTotalTransfer): ErpOrderTotalTransfer;

    /**
     * @param \Generated\Shared\Transfer\ErpOrderTotalTransfer $erpOrderTotalTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderTotalTransfer
     */
    public function executePreSavePlugins(ErpOrderTotalTransfer $erpOrderTotalTransfer): ErpOrderTotalTransfer;
}
