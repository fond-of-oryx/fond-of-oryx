<?php

namespace FondOfOryx\Zed\ErpInvoice\Communication\Plugin\PreSave;

use FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoiceItemPreSavePluginInterface;
use Generated\Shared\Transfer\ErpInvoiceItemTransfer;
use Generated\Shared\Transfer\ErpInvoiceTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @package FondOfOryx\Zed\ErpInvoice\Communication\Plugin\PostSave
 *
 * @method \FondOfOryx\Zed\ErpInvoice\Business\ErpInvoiceFacadeInterface getFacade()
 */
class ErpInvoiceItemAmountsPersisterErpInvoiceItemPreSavePlugin extends AbstractPlugin implements ErpInvoiceItemPreSavePluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceItemTransfer $erpInvoiceItemTransfer
     * @param \Generated\Shared\Transfer\ErpInvoiceTransfer|null $existingErpInvoiceTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceItemTransfer
     */
    public function preSave(ErpInvoiceItemTransfer $erpInvoiceItemTransfer, ?ErpInvoiceTransfer $existingErpInvoiceTransfer = null): ErpInvoiceItemTransfer
    {
        return $this->getFacade()->persistErpInvoiceItemAmounts($erpInvoiceItemTransfer, $existingErpInvoiceTransfer);
    }
}
