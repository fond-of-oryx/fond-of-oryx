<?php

namespace FondOfOryx\Zed\Invoice\Business;

use Generated\Shared\Transfer\InvoiceResponseTransfer;
use Generated\Shared\Transfer\InvoiceTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\Invoice\Business\InvoiceBusinessFactory getFactory()
 * @method \FondOfOryx\Zed\Invoice\Persistence\InvoiceEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\Invoice\Persistence\InvoiceRepositoryInterface getRepository()
 */
class InvoiceFacade extends AbstractFacade implements InvoiceFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\InvoiceTransfer $invoiceTransfer
     *
     * @return \Generated\Shared\Transfer\InvoiceResponseTransfer
     */
    public function createInvoice(InvoiceTransfer $invoiceTransfer): InvoiceResponseTransfer
    {
        return $this->getFactory()->createInvoiceWriter()->create($invoiceTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\InvoiceTransfer $invoiceTransfer
     *
     * @return \Generated\Shared\Transfer\InvoiceTransfer
     */
    public function createInvoiceAddress(InvoiceTransfer $invoiceTransfer): InvoiceTransfer
    {
        return $this->getFactory()->createInvoiceAddressWriter()->create($invoiceTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\InvoiceTransfer $invoiceTransfer
     *
     * @return \Generated\Shared\Transfer\InvoiceTransfer
     */
    public function createInvoiceItems(InvoiceTransfer $invoiceTransfer): InvoiceTransfer
    {
        return $this->getFactory()->createInvoiceItemsWriter()->create($invoiceTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return string
     */
    public function createInvoiceReference(): string
    {
        return $this->getFactory()->createInvoiceReferenceGenerator()->generate();
    }
}
