<?php

namespace FondOfOryx\Zed\ErpOrder\Business\Model\Reader;

use FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderRepositoryInterface;
use Generated\Shared\Transfer\ErpOrderTotalsTransfer;

class ErpOrderTotalsReader implements ErpOrderTotalsReaderInterface
{
    /**
     * @var \FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderRepositoryInterface
     */
    protected $repository;

    /**
     * @param \FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderRepositoryInterface $repository
     */
    public function __construct(ErpOrderRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $idErpOrderTotals
     *
     * @return \Generated\Shared\Transfer\ErpOrderTotalsTransfer|null
     */
    public function findErpOrderTotalsByIdErpOrderTotals(int $idErpOrderTotals): ?ErpOrderTotalsTransfer
    {
        return $this->repository->findErpOrderTotalsByIdErpOrderTotals($idErpOrderTotals);
    }
}
