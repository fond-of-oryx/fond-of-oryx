<?php

namespace FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin;

use Generated\Shared\Transfer\ErpOrderTotalsTransfer;

interface ErpOrderTotalsPreSavePluginInterface
{
    /**
     * Specification:
     * - Plugin is triggered before erp order total object is saved.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ErpOrderTotalsTransfer $erpOrderTotalsTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderTotalsTransfer
     */
    public function preSave(ErpOrderTotalsTransfer $erpOrderTotalsTransfer): ErpOrderTotalsTransfer;
}
