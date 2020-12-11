<?php

namespace FondOfOryx\Zed\ErpOrder\Business\PluginExecutor;

use Generated\Shared\Transfer\ErpOrderItemTransfer;

interface ErpOrderItemPluginExecutorInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpOrderItemTransfer $erpOrderItemTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderItemTransfer
     */
    public function executePostSavePlugins(ErpOrderItemTransfer $erpOrderItemTransfer): ErpOrderItemTransfer;

    /**
     * @param \Generated\Shared\Transfer\ErpOrderItemTransfer $erpOrderItemTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderItemTransfer
     */
    public function executePreSavePlugins(ErpOrderItemTransfer $erpOrderItemTransfer): ErpOrderItemTransfer;
}
