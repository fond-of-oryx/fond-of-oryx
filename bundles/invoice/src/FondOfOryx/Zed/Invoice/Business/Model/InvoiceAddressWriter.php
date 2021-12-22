<?php

namespace FondOfOryx\Zed\Invoice\Business\Model;

use FondOfOryx\Zed\Invoice\Persistence\InvoiceEntityManagerInterface;
use Generated\Shared\Transfer\InvoiceTransfer;

class InvoiceAddressWriter implements InvoiceAddressWriterInterface
{
    /**
     * @var \FondOfOryx\Zed\Invoice\Persistence\InvoiceEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @param \FondOfOryx\Zed\Invoice\Persistence\InvoiceEntityManagerInterface $entityManager
     */
    public function __construct(InvoiceEntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param \Generated\Shared\Transfer\InvoiceTransfer $invoiceTransfer
     *
     * @return \Generated\Shared\Transfer\InvoiceTransfer
     */
    public function create(InvoiceTransfer $invoiceTransfer): InvoiceTransfer
    {
        $invoiceTransfer->requireAddress();
        $invoiceAddressTransfer = $this->entityManager->createInvoiceAddress($invoiceTransfer->getAddress());

        return $invoiceTransfer->setAddress($invoiceAddressTransfer);
    }
}
