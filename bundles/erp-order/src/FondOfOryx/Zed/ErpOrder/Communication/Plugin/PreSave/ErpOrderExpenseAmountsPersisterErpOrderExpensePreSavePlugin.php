<?php

namespace FondOfOryx\Zed\ErpOrder\Communication\Plugin\PreSave;

use FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderExpensePreSavePluginInterface;
use Generated\Shared\Transfer\ErpOrderExpenseTransfer;
use Generated\Shared\Transfer\ErpOrderTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @package FondOfOryx\Zed\ErpOrder\Communication\Plugin\PostSave
 *
 * @method \FondOfOryx\Zed\ErpOrder\Business\ErpOrderFacadeInterface getFacade()
 */
class ErpOrderExpenseAmountsPersisterErpOrderExpensePreSavePlugin extends AbstractPlugin implements ErpOrderExpensePreSavePluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpOrderExpenseTransfer $erpOrderExpenseTransfer
     * @param \Generated\Shared\Transfer\ErpOrderTransfer|null $existingErpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderExpenseTransfer
     */
    public function preSave(
        ErpOrderExpenseTransfer $erpOrderExpenseTransfer,
        ?ErpOrderTransfer $existingErpOrderTransfer = null
    ): ErpOrderExpenseTransfer {
        return $this->getFacade()->persistErpOrderExpenseAmounts($erpOrderExpenseTransfer, $existingErpOrderTransfer);
    }
}
