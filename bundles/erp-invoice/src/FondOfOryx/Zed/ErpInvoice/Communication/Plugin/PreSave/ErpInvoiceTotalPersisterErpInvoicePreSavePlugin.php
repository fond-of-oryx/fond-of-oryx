<?php

namespace FondOfOryx\Zed\ErpInvoice\Communication\Plugin\PreSave;

use FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoicePreSavePluginInterface;
use Generated\Shared\Transfer\ErpInvoiceTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @package FondOfOryx\Zed\ErpInvoice\Communication\Plugin\PostSave
 *
 * @method \FondOfOryx\Zed\ErpInvoice\Business\ErpInvoiceFacadeInterface getFacade()
 */
class ErpInvoiceTotalPersisterErpInvoicePreSavePlugin extends AbstractPlugin implements ErpInvoicePreSavePluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceTransfer $erpInvoiceTransfer
     * @param \Generated\Shared\Transfer\ErpInvoiceTransfer|null $existingErpInvoiceTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceTransfer
     */
    public function preSave(ErpInvoiceTransfer $erpInvoiceTransfer, ?ErpInvoiceTransfer $existingErpInvoiceTransfer = null): ErpInvoiceTransfer
    {
        return $this->getFacade()->persistErpInvoiceAmount($erpInvoiceTransfer, $existingErpInvoiceTransfer);
    }
}
