<?php

namespace FondOfOryx\Zed\ErpOrder\Business\Model\Writer;

use Generated\Shared\Transfer\ErpOrderTotalTransfer;

interface ErpOrderTotalWriterInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpOrderTotalTransfer $erpOrderTotalTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderTotalTransfer
     */
    public function create(ErpOrderTotalTransfer $erpOrderTotalTransfer): ErpOrderTotalTransfer;

    /**
     * @param \Generated\Shared\Transfer\ErpOrderTotalTransfer $erpOrderTotalTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderTotalTransfer
     */
    public function update(ErpOrderTotalTransfer $erpOrderTotalTransfer): ErpOrderTotalTransfer;
}
