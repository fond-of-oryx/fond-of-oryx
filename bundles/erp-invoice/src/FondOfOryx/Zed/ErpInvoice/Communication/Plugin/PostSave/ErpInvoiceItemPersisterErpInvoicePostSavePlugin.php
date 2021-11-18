<?php

namespace FondOfOryx\Zed\ErpInvoice\Communication\Plugin\PostSave;

use FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoicePostSavePluginInterface;
use Generated\Shared\Transfer\ErpInvoiceTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * Class ErpInvoiceAddressPreSavePlugin
 *
 * @package FondOfOryx\Zed\ErpInvoice\Communication\Plugin\PreSave
 *
 * @method \FondOfOryx\Zed\ErpInvoice\Business\ErpInvoiceFacadeInterface getFacade()
 */
class ErpInvoiceItemPersisterErpInvoicePostSavePlugin extends AbstractPlugin implements ErpInvoicePostSavePluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceTransfer $erpInvoiceTransfer
     * @param \Generated\Shared\Transfer\ErpInvoiceTransfer|null $existingErpInvoiceTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceTransfer
     */
    public function postSave(ErpInvoiceTransfer $erpInvoiceTransfer, ?ErpInvoiceTransfer $existingErpInvoiceTransfer = null): ErpInvoiceTransfer
    {
        return $this->getFacade()->persistErpInvoiceItem($erpInvoiceTransfer, $existingErpInvoiceTransfer);
    }
}
