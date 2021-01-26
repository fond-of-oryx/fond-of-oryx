<?php

namespace FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin;

use Generated\Shared\Transfer\ErpOrderTransfer;

interface ErpOrderPostSavePluginInterface
{
    /**
     * Specification:
     * - Plugin is triggered after erp order object was saved.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ErpOrderTransfer $erpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderTransfer
     */
    public function postSave(ErpOrderTransfer $erpOrderTransfer): ErpOrderTransfer;
}
