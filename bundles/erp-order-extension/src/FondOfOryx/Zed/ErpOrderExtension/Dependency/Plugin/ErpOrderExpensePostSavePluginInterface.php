<?php

namespace FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin;

use Generated\Shared\Transfer\ErpOrderExpenseTransfer;
use Generated\Shared\Transfer\ErpOrderTransfer;

interface ErpOrderExpensePostSavePluginInterface
{
    /**
     * Specification:
     * - Plugin is triggered after erp invoice expense object was saved.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ErpOrderExpenseTransfer $erpOrderExpenseTransfer
     * @param \Generated\Shared\Transfer\ErpOrderTransfer|null $existingErpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderExpenseTransfer
     */
    public function postSave(
        ErpOrderExpenseTransfer $erpOrderExpenseTransfer,
        ?ErpOrderTransfer $existingErpOrderTransfer = null
    ): ErpOrderExpenseTransfer;
}
