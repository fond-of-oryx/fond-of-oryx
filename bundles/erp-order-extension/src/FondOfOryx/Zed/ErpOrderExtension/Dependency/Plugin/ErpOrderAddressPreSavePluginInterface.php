<?php

namespace FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin;

use Generated\Shared\Transfer\ErpOrderAddressTransfer;

interface ErpOrderAddressPreSavePluginInterface
{
    /**
     * Specification:
     * - Plugin is triggered before erp order address object is saved.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ErpOrderAddressTransfer $erpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderAddressTransfer
     */
    public function preSave(ErpOrderAddressTransfer $erpOrderTransfer): ErpOrderAddressTransfer;
}
