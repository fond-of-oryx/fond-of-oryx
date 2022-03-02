<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderCompanyBusinessUnit\Business;

use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;

interface JellyfishSalesOrderCompanyBusinessUnitFacadeInterface
{
    /**
     * Specifications:
     * - Expands jellyfish order with company business unit fields (id & uuid)
     * - ...
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\JellyfishOrderTransfer $jellyfishOrderTransfer
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $salesOrder
     *
     * @return \Generated\Shared\Transfer\JellyfishOrderTransfer
     */
    public function expandJellyfishOrder(
        JellyfishOrderTransfer $jellyfishOrderTransfer,
        SpySalesOrder $salesOrder
    ): JellyfishOrderTransfer;
}
