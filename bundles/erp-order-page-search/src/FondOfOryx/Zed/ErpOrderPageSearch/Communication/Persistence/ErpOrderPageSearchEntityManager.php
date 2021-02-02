<?php

namespace FondOfOryx\Zed\ErporderPageSearch\Persistence;

use Generated\Shared\Transfer\ErpOrderPageSearchTransfer;

class ErpOrderPageSearchEntityManager extends AbstractEntityManager implements ErpOrderPageSearchEntityManagerInterface
{

    /**
     * @param array $erpOrderIds
     */
    public function deleteErpOrderSearchPagesByErpOrderIds(array $erpOrderIds): void
    {
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderPageSearchTransfer $erpOrderPageSearchTransfer
     */
    public function createErpOrderPageSearch(ErpOrderPageSearchTransfer $erpOrderPageSearchTransfer): void
    {

    }
}
