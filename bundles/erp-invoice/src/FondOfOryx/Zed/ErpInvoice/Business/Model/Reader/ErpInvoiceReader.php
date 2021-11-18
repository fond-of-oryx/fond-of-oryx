<?php

namespace FondOfOryx\Zed\ErpInvoice\Business\Model\Reader;

use FondOfOryx\Zed\ErpInvoice\Persistence\ErpInvoiceRepositoryInterface;
use Generated\Shared\Transfer\ErpInvoiceTransfer;

class ErpInvoiceReader implements ErpInvoiceReaderInterface
{
    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Persistence\ErpInvoiceRepositoryInterface
     */
    protected $repository;

    /**
     * @param \FondOfOryx\Zed\ErpInvoice\Persistence\ErpInvoiceRepositoryInterface $repository
     */
    public function __construct(ErpInvoiceRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $idErpInvoice
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceTransfer|null
     */
    public function findErpInvoiceByIdErpInvoice(int $idErpInvoice): ?ErpInvoiceTransfer
    {
        return $this->repository->findErpInvoiceByIdErpInvoice($idErpInvoice);
    }

    /**
     * @param string $erpInvoiceExternalReference
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceTransfer|null
     */
    public function findErpInvoiceByExternalReference(string $erpInvoiceExternalReference): ?ErpInvoiceTransfer
    {
        return $this->repository->findErpInvoiceByExternalReference($erpInvoiceExternalReference);
    }
}
