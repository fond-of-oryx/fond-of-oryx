<?php

namespace FondOfOryx\Zed\ErpInvoice\Communication\Plugin\PreSave;

use FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoiceExpensePreSavePluginInterface;
use Generated\Shared\Transfer\ErpInvoiceExpenseTransfer;
use Generated\Shared\Transfer\ErpInvoiceTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @package FondOfOryx\Zed\ErpInvoice\Communication\Plugin\PostSave
 *
 * @method \FondOfOryx\Zed\ErpInvoice\Business\ErpInvoiceFacadeInterface getFacade()
 */
class ErpInvoiceExpenseAmountsPersisterErpInvoiceExpensePreSavePlugin extends AbstractPlugin implements ErpInvoiceExpensePreSavePluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceExpenseTransfer $erpInvoiceExpenseTransfer
     * @param \Generated\Shared\Transfer\ErpInvoiceTransfer|null $existingErpInvoiceTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceExpenseTransfer
     */
    public function preSave(
        ErpInvoiceExpenseTransfer $erpInvoiceExpenseTransfer,
        ?ErpInvoiceTransfer $existingErpInvoiceTransfer = null
    ): ErpInvoiceExpenseTransfer {
        return $this->getFacade()->persistErpInvoiceExpenseAmounts($erpInvoiceExpenseTransfer, $existingErpInvoiceTransfer);
    }
}
