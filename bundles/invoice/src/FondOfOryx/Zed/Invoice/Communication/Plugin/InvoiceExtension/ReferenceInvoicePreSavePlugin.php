<?php

namespace FondOfOryx\Zed\Invoice\Communication\Plugin\InvoiceExtension;

use FondOfOryx\Zed\InvoiceExtension\Dependency\Plugin\InvoicePreSavePluginInterface;
use Generated\Shared\Transfer\InvoiceTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\Invoice\Business\InvoiceFacade getFacade()
 * @method \FondOfOryx\Zed\Invoice\InvoiceConfig getConfig()
 */
class ReferenceInvoicePreSavePlugin extends AbstractPlugin implements InvoicePreSavePluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\InvoiceTransfer $invoiceTransfer
     *
     * @return \Generated\Shared\Transfer\InvoiceTransfer
     */
    public function preSave(InvoiceTransfer $invoiceTransfer): InvoiceTransfer
    {
        return $invoiceTransfer->setInvoiceReference(
            $this->getFacade()->createInvoiceReference(),
        );
    }
}
