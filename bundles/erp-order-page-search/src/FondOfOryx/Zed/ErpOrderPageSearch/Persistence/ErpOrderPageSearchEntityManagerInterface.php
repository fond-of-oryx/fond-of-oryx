<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch\Persistence;

interface ErpOrderPageSearchEntityManagerInterface
{
    /**
     * @param array $erpOrderIds
     *
     * @return void
     */
    public function deleteErpOrderSearchPagesByErpOrderIds(array $erpOrderIds): void;

    /**
     * @param \FondOfOryx\Zed\ErpOrderPageSearch\Persistence\ErpOrderPageSearchTransfer $erpOrderPageSearchTransfer
     */
    public function createErpOrderPageSearch(ErpOrderPageSearchTransfer $erpOrderPageSearchTransfer): void;
}
