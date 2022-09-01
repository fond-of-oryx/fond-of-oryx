<?php

namespace FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin;

use Generated\Shared\Transfer\ErpOrderTotalsTransfer;

interface ErpOrderTotalsPostSavePluginInterface
{
    /**
     * Specification:
     * - Plugin is triggered after erp order total object was saved.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ErpOrderTotalsTransfer $erpOrderTotalsTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderTotalsTransfer
     */
    public function postSave(ErpOrderTotalsTransfer $erpOrderTotalsTransfer): ErpOrderTotalsTransfer;
}
