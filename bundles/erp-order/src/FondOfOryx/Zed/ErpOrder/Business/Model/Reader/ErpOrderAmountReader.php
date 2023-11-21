<?php

namespace FondOfOryx\Zed\ErpOrder\Business\Model\Reader;

use FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderRepositoryInterface;
use Generated\Shared\Transfer\ErpOrderAmountTransfer;

class ErpOrderAmountReader implements ErpOrderAmountReaderInterface
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
     * @param int $idErpOrderAmount
     *
     * @return \Generated\Shared\Transfer\ErpOrderAmountTransfer|null
     */
    public function findErpOrderAmountByIdErpOrderAmount(int $idErpOrderAmount): ?ErpOrderAmountTransfer
    {
        return $this->repository->findErpOrderAmountByIdErpOrderAmount($idErpOrderAmount);
    }
}
