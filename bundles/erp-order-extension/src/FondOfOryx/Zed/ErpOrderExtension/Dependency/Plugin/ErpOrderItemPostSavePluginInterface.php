<?php

namespace FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin;

use Generated\Shared\Transfer\ErpOrderItemTransfer;

interface ErpOrderItemPostSavePluginInterface
{
    /**
     * Specification:
     * - Plugin is triggered after erp order item object was saved.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ErpOrderItemTransfer $erpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderItemTransfer
     */
    public function postSave(ErpOrderItemTransfer $erpOrderTransfer): ErpOrderItemTransfer;
}
