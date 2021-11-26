<?php

namespace FondOfOryx\Zed\ErpInvoice\Business\Model\Reader;

use FondOfOryx\Zed\ErpInvoice\Persistence\ErpInvoiceRepositoryInterface;
use Generated\Shared\Transfer\ErpInvoiceExpenseCollectionTransfer;
use Generated\Shared\Transfer\ErpInvoiceExpenseTransfer;

class ErpInvoiceExpenseReader implements ErpInvoiceExpenseReaderInterface
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
     * @return \Generated\Shared\Transfer\ErpInvoiceExpenseCollectionTransfer
     */
    public function findErpInvoiceExpensesByIdErpInvoice(int $idErpInvoice): ErpInvoiceExpenseCollectionTransfer
    {
        return $this->repository->findErpInvoiceExpensesByIdErpInvoice($idErpInvoice);
    }

    /**
     * @param int $idErpInvoiceExpense
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceExpenseTransfer|null
     */
    public function findErpInvoiceExpenseByIdErpInvoiceExpense(int $idErpInvoiceExpense): ?ErpInvoiceExpenseTransfer
    {
        return $this->repository->findErpInvoiceExpenseByIdErpInvoiceExpense($idErpInvoiceExpense);
    }
}
