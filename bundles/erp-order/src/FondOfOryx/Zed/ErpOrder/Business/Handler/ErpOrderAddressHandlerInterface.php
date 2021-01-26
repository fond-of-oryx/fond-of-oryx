<?php

namespace FondOfOryx\Zed\ErpOrder\Business\Handler;

use Generated\Shared\Transfer\ErpOrderTransfer;

interface ErpOrderAddressHandlerInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpOrderTransfer $erpOrderTransfer
     * @param string $addressType
     *
     * @return \Generated\Shared\Transfer\ErpOrderTransfer
     */
    public function handle(ErpOrderTransfer $erpOrderTransfer, string $addressType): ErpOrderTransfer;
}
