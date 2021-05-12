<?php

namespace FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin;

use Generated\Shared\Transfer\ErpOrderTotalTransfer;

interface ErpOrderTotalPostSavePluginInterface
{
    /**
     * Specification:
     * - Plugin is triggered after erp order total object was saved.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ErpOrderTotalTransfer $erpOrderTotalTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderTotalTransfer
     */
    public function postSave(ErpOrderTotalTransfer $erpOrderTotalTransfer): ErpOrderTotalTransfer;
}
