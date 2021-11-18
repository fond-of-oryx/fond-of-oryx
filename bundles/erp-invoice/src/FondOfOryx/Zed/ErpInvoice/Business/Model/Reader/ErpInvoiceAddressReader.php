<?php

namespace FondOfOryx\Zed\ErpInvoice\Business\Model\Reader;

use FondOfOryx\Zed\ErpInvoice\Persistence\ErpInvoiceRepositoryInterface;
use Generated\Shared\Transfer\ErpInvoiceAddressTransfer;

class ErpInvoiceAddressReader implements ErpInvoiceAddressReaderInterface
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
     * @param int $idErpInvoiceAddress
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceAddressTransfer|null
     */
    public function findErpInvoiceAddressByIdErpInvoiceAddress(int $idErpInvoiceAddress): ?ErpInvoiceAddressTransfer
    {
        return $this->repository->findErpInvoiceAddressByIdErpInvoiceAddress($idErpInvoiceAddress);
    }
}
