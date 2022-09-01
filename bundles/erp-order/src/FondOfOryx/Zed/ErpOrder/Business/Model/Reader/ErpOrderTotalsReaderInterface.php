<?php

namespace FondOfOryx\Zed\ErpOrder\Business\Model\Reader;

use Generated\Shared\Transfer\ErpOrderTotalsTransfer;

interface ErpOrderTotalsReaderInterface
{
    /**
     * @param int $idErpOrderTotals
     *
     * @return \Generated\Shared\Transfer\ErpOrderTotalsTransfer|null
     */
    public function findErpOrderTotalsByIdErpOrderTotals(int $idErpOrderTotals): ?ErpOrderTotalsTransfer;
}
