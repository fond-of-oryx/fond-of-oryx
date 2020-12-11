<?php

namespace FondOfOryx\Zed\ErpOrder\Business\PluginExecutor;

use Generated\Shared\Transfer\ErpOrderTransfer;

interface ErpOrderPluginExecutorInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpOrderTransfer $erpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderTransfer
     */
    public function executePostSavePlugins(ErpOrderTransfer $erpOrderTransfer): ErpOrderTransfer;

    /**
     * @param \Generated\Shared\Transfer\ErpOrderTransfer $erpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderTransfer
     */
    public function executePreSavePlugins(ErpOrderTransfer $erpOrderTransfer): ErpOrderTransfer;
}
