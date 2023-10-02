<?php

namespace FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin;

use Generated\Shared\Transfer\ErpOrderItemTransfer;

interface ErpOrderItemPreSavePluginInterface
{
    /**
     * Specification:
     * - Plugin is triggered before erp order item object is saved.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ErpOrderItemTransfer $erpOrderItemTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderItemTransfer
     */
    public function preSave(ErpOrderItemTransfer $erpOrderItemTransfer): ErpOrderItemTransfer;
}
