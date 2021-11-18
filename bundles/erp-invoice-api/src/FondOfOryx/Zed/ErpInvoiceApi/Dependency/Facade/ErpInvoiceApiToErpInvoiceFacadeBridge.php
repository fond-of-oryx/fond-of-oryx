<?php

namespace FondOfOryx\Zed\ErpInvoiceApi\Dependency\Facade;

use FondOfOryx\Zed\ErpInvoice\Business\ErpInvoiceFacadeInterface;
use Generated\Shared\Transfer\ErpInvoiceResponseTransfer;
use Generated\Shared\Transfer\ErpInvoiceTransfer;

class ErpInvoiceApiToErpInvoiceFacadeBridge implements ErpInvoiceApiToErpInvoiceFacadeInterface
{
    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Business\ErpInvoiceFacadeInterface
     */
    protected $erpInvoiceFacade;

    /**
     * @param \FondOfOryx\Zed\ErpInvoice\Business\ErpInvoiceFacadeInterface $erpInvoiceFacade
     */
    public function __construct(ErpInvoiceFacadeInterface $erpInvoiceFacade)
    {
        $this->erpInvoiceFacade = $erpInvoiceFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceTransfer $erpInvoiceTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceResponseTransfer
     */
    public function createErpInvoice(ErpInvoiceTransfer $erpInvoiceTransfer): ErpInvoiceResponseTransfer
    {
        return $this->erpInvoiceFacade->createErpInvoice($erpInvoiceTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceTransfer $erpInvoiceTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceResponseTransfer
     */
    public function updateErpInvoice(ErpInvoiceTransfer $erpInvoiceTransfer): ErpInvoiceResponseTransfer
    {
        return $this->erpInvoiceFacade->updateErpInvoice($erpInvoiceTransfer);
    }

    /**
     * @param int $idErpInvoice
     *
     * @return void
     */
    public function deleteErpInvoiceByIdErpInvoice(int $idErpInvoice): void
    {
        $this->erpInvoiceFacade->deleteErpInvoiceByIdErpInvoice($idErpInvoice);
    }

    /**
     * @param int $idErpInvoice
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceTransfer|null
     */
    public function findErpInvoiceByIdErpInvoice(int $idErpInvoice): ?ErpInvoiceTransfer
    {
        return $this->erpInvoiceFacade->findErpInvoiceByIdErpInvoice($idErpInvoice);
    }
}
