<?php

namespace FondOfOryx\Zed\ErpOrder\Business\Model\Reader;

use Generated\Shared\Transfer\ErpOrderTotalTransfer;

interface ErpOrderTotalReaderInterface
{
    /**
     * @param int $idErpOrderTotal
     *
     * @return \Generated\Shared\Transfer\ErpOrderTotalTransfer|null
     */
    public function findErpOrderTotalByIdErpOrderTotal(int $idErpOrderTotal): ?ErpOrderTotalTransfer;

    /**
     * @param int $idErpOrder
     *
     * @return \Generated\Shared\Transfer\ErpOrderTotalTransfer|null
     */
    public function findErpOrderTotalByIdErpOrder(int $idErpOrder): ?ErpOrderTotalTransfer;
}
