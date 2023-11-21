<?php

namespace FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin;

use Generated\Shared\Transfer\ErpOrderAmountTransfer;
use Generated\Shared\Transfer\ErpOrderTransfer;

interface ErpOrderAmountPreSavePluginInterface
{
    /**
     * Specification:
     * - Plugin is triggered before erp invoice amount object is saved.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ErpOrderAmountTransfer $erpOrderAmountTransfer
     * @param \Generated\Shared\Transfer\ErpOrderTransfer|null $existingErpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderAmountTransfer
     */
    public function preSave(
        ErpOrderAmountTransfer $erpOrderAmountTransfer,
        ?ErpOrderTransfer $existingErpOrderTransfer = null
    ): ErpOrderAmountTransfer;
}
