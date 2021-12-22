<?php

namespace FondOfOryx\Zed\Invoice\Communication\Plugin\InvoiceExtension;

use FondOfOryx\Zed\InvoiceExtension\Dependency\Plugin\InvoicePostSavePluginInterface;
use Generated\Shared\Transfer\InvoiceTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\Invoice\Business\InvoiceFacade getFacade()
 * @method \FondOfOryx\Zed\Invoice\InvoiceConfig getConfig()
 */
class ItemsInvoicePostSavePlugin extends AbstractPlugin implements InvoicePostSavePluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\InvoiceTransfer $invoiceTransfer
     *
     * @return \Generated\Shared\Transfer\InvoiceTransfer
     */
    public function postSave(InvoiceTransfer $invoiceTransfer): InvoiceTransfer
    {
        return $this->getFacade()->createInvoiceItems($invoiceTransfer);
    }
}
