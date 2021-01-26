<?php

namespace FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin;

use Generated\Shared\Transfer\ErpOrderAddressTransfer;

interface ErpOrderAddressPostSavePluginInterface
{
    /**
     * Specification:
     * - Plugin is triggered after erp order address object was saved.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ErpOrderAddressTransfer $erpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderAddressTransfer
     */
    public function postSave(ErpOrderAddressTransfer $erpOrderTransfer): ErpOrderAddressTransfer;
}
