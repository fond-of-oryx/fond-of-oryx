<?php

namespace FondOfOryx\Zed\ErpOrder\Business\Model\Writer;

use Generated\Shared\Transfer\ErpOrderItemTransfer;

interface ErpOrderItemWriterInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpOrderItemTransfer $erpOrderItemTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderItemTransfer
     */
    public function create(ErpOrderItemTransfer $erpOrderItemTransfer): ErpOrderItemTransfer;

    /**
     * @param \Generated\Shared\Transfer\ErpOrderItemTransfer $erpOrderItemTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderItemTransfer
     */
    public function update(ErpOrderItemTransfer $erpOrderItemTransfer): ErpOrderItemTransfer;

    /**
     * @param int $idErpOrderItem
     *
     * @return void
     */
    public function delete(int $idErpOrderItem): void;
}
