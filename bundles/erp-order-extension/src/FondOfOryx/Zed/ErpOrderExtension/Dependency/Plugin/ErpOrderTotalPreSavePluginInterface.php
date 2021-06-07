<?php

namespace FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin;

use Generated\Shared\Transfer\ErpOrderTotalTransfer;

interface ErpOrderTotalPreSavePluginInterface
{
    /**
     * Specification:
     * - Plugin is triggered before erp order total object is saved.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ErpOrderTotalTransfer $erpOrderTotalTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderTotalTransfer
     */
    public function preSave(ErpOrderTotalTransfer $erpOrderTotalTransfer): ErpOrderTotalTransfer;
}
