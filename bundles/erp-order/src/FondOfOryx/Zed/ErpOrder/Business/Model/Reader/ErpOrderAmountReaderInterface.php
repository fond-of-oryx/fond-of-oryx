<?php

namespace FondOfOryx\Zed\ErpOrder\Business\Model\Reader;

use Generated\Shared\Transfer\ErpOrderAmountTransfer;

interface ErpOrderAmountReaderInterface
{
    /**
     * @param int $idErpOrderAmount
     *
     * @return \Generated\Shared\Transfer\ErpOrderAmountTransfer|null
     */
    public function findErpOrderAmountByIdErpOrderAmount(int $idErpOrderAmount): ?ErpOrderAmountTransfer;
}
