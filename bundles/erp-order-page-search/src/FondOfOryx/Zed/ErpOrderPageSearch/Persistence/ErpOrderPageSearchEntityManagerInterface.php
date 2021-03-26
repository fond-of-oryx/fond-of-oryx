<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch\Persistence;

use Generated\Shared\Transfer\ErpOrderPageSearchTransfer;

interface ErpOrderPageSearchEntityManagerInterface
{
    /**
     * @param array $erpOrderIds
     *
     * @return void
     */
    public function deleteErpOrderSearchPagesByErpOrderIds(array $erpOrderIds): void;

    /**
     * @param \Generated\Shared\Transfer\ErpOrderPageSearchTransfer $erpOrderPageSearchTransfer
     *
     * @return void
     */
    public function createErpOrderPageSearch(ErpOrderPageSearchTransfer $erpOrderPageSearchTransfer): void;
}
