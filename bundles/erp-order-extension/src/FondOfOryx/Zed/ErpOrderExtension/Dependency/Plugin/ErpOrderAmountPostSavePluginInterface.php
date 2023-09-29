<?php

namespace FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin;

use Generated\Shared\Transfer\ErpOrderAmountTransfer;
use Generated\Shared\Transfer\ErpOrderTransfer;

interface ErpOrderAmountPostSavePluginInterface
{
    /**
     * Specification:
     * - Plugin is triggered after erp invoice total object was saved.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ErpOrderAmountTransfer $erpOrderAmountTransfer
     * @param \Generated\Shared\Transfer\ErpOrderTransfer|null $existingErpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderAmountTransfer
     */
    public function postSave(
        ErpOrderAmountTransfer $erpOrderAmountTransfer,
        ?ErpOrderTransfer $existingErpOrderTransfer = null
    ): ErpOrderAmountTransfer;
}
