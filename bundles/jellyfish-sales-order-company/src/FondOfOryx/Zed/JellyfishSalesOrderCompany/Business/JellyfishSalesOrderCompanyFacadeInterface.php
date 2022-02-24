<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderCompany\Business;

use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;

interface JellyfishSalesOrderCompanyFacadeInterface
{
    /**
     * Specifications:
     * - Expands jellyfish order with company fileds (id & uuid)
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
