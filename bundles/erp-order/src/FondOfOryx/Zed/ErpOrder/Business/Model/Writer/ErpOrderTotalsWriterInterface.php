<?php

namespace FondOfOryx\Zed\ErpOrder\Business\Model\Writer;

use Generated\Shared\Transfer\ErpOrderTotalsTransfer;

interface ErpOrderTotalsWriterInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpOrderTotalsTransfer $erpOrderTotalsTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderTotalsTransfer
     */
    public function create(ErpOrderTotalsTransfer $erpOrderTotalsTransfer): ErpOrderTotalsTransfer;

    /**
     * @param \Generated\Shared\Transfer\ErpOrderTotalsTransfer $erpOrderTotalsTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderTotalsTransfer
     */
    public function update(ErpOrderTotalsTransfer $erpOrderTotalsTransfer): ErpOrderTotalsTransfer;

    /**
     * @param int $idErpOrderTotals
     *
     * @return void
     */
    public function delete(int $idErpOrderTotals): void;
}
