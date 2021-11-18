<?php

namespace FondOfOryx\Zed\ErpInvoice\Business\Model\Reader;

use FondOfOryx\Zed\ErpInvoice\Persistence\ErpInvoiceRepositoryInterface;
use Generated\Shared\Transfer\ErpInvoiceAmountTransfer;

class ErpInvoiceAmountReader implements ErpInvoiceAmountReaderInterface
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
     * @param int $idErpInvoiceAmount
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceAmountTransfer|null
     */
    public function findErpInvoiceAmountByIdErpInvoiceAmount(int $idErpInvoiceAmount): ?ErpInvoiceAmountTransfer
    {
        return $this->repository->findErpInvoiceAmountByIdErpInvoiceAmount($idErpInvoiceAmount);
    }
}
