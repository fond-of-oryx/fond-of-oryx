<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\Business;

use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;

interface JellyfishSalesOrderGiftCardProportionalValueConnectorFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderTransfer $jellyfishOrderTransfer
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $spySalesOrder
     *
     * @return \Generated\Shared\Transfer\JellyfishOrderTransfer
     */
    public function mapProportionalGiftCardValues(JellyfishOrderTransfer $jellyfishOrderTransfer, SpySalesOrder $spySalesOrder): JellyfishOrderTransfer;
}
