<?php

namespace FondOfOryx\Zed\InvoiceApi\Dependency\Facade;

use FondOfOryx\Zed\Invoice\Business\InvoiceFacadeInterface;
use Generated\Shared\Transfer\InvoiceResponseTransfer;
use Generated\Shared\Transfer\InvoiceTransfer;

class InvoiceApiToInvoiceFacadeBridge implements InvoiceApiToInvoiceFacadeInterface
{
    /**
     * @var \FondOfOryx\Zed\Invoice\Business\InvoiceFacadeInterface
     */
    protected $invoiceFacade;

    /**
     * @param \FondOfOryx\Zed\Invoice\Business\InvoiceFacadeInterface $invoiceFacade
     */
    public function __construct(InvoiceFacadeInterface $invoiceFacade)
    {
        $this->invoiceFacade = $invoiceFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\InvoiceTransfer $invoiceTransfer
     *
     * @return \Generated\Shared\Transfer\InvoiceResponseTransfer
     */
    public function createInvoice(InvoiceTransfer $invoiceTransfer): InvoiceResponseTransfer
    {
        return $this->invoiceFacade->createInvoice($invoiceTransfer);
    }
}
