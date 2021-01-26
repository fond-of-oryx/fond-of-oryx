<?php

namespace FondOfOryx\Zed\ErpOrder\Business\PluginExecutor;

use Generated\Shared\Transfer\ErpOrderAddressTransfer;

interface ErpOrderAddressPluginExecutorInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpOrderAddressTransfer $erpOrderAddressTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderAddressTransfer
     */
    public function executePostSavePlugins(ErpOrderAddressTransfer $erpOrderAddressTransfer): ErpOrderAddressTransfer;

    /**
     * @param \Generated\Shared\Transfer\ErpOrderAddressTransfer $erpOrderAddressTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderAddressTransfer
     */
    public function executePreSavePlugins(ErpOrderAddressTransfer $erpOrderAddressTransfer): ErpOrderAddressTransfer;
}
