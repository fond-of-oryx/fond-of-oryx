<?php

namespace FondOfOryx\Zed\ErpOrder\Business\Model\Writer;

use Generated\Shared\Transfer\ErpOrderResponseTransfer;
use Generated\Shared\Transfer\ErpOrderTransfer;

interface ErpOrderWriterInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpOrderTransfer $erpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderResponseTransfer
     */
    public function create(ErpOrderTransfer $erpOrderTransfer): ErpOrderResponseTransfer;

    /**
     * @param \Generated\Shared\Transfer\ErpOrderTransfer $erpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderResponseTransfer
     */
    public function update(ErpOrderTransfer $erpOrderTransfer): ErpOrderResponseTransfer;

    /**
     * @param int $idErpOrder
     *
     * @return void
     */
    public function delete(int $idErpOrder): void;
}
