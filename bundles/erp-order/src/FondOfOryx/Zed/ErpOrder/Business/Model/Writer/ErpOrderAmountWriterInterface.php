<?php

namespace FondOfOryx\Zed\ErpOrder\Business\Model\Writer;

use Generated\Shared\Transfer\ErpOrderAmountTransfer;

interface ErpOrderAmountWriterInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpOrderAmountTransfer $erpOrderAmountTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderAmountTransfer
     */
    public function create(ErpOrderAmountTransfer $erpOrderAmountTransfer): ErpOrderAmountTransfer;

    /**
     * @param \Generated\Shared\Transfer\ErpOrderAmountTransfer $erpOrderAmountTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderAmountTransfer
     */
    public function update(ErpOrderAmountTransfer $erpOrderAmountTransfer): ErpOrderAmountTransfer;
}
