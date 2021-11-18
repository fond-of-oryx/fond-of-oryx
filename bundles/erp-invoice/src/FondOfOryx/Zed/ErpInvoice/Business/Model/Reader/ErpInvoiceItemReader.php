<?php

namespace FondOfOryx\Zed\ErpInvoice\Business\Model\Reader;

use FondOfOryx\Zed\ErpInvoice\Persistence\ErpInvoiceRepositoryInterface;
use Generated\Shared\Transfer\ErpInvoiceItemCollectionTransfer;
use Generated\Shared\Transfer\ErpInvoiceItemTransfer;

class ErpInvoiceItemReader implements ErpInvoiceItemReaderInterface
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
     * @return \Generated\Shared\Transfer\ErpInvoiceItemCollectionTransfer
     */
    public function findErpInvoiceItemsByIdErpInvoice(int $idErpInvoice): ErpInvoiceItemCollectionTransfer
    {
        return $this->repository->findErpInvoiceItemsByIdErpInvoice($idErpInvoice);
    }

    /**
     * @param int $idErpInvoiceItem
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceItemTransfer|null
     */
    public function findErpInvoiceItemByIdErpInvoiceItem(int $idErpInvoiceItem): ?ErpInvoiceItemTransfer
    {
        return $this->repository->findErpInvoiceItemByIdErpInvoiceItem($idErpInvoiceItem);
    }
}
