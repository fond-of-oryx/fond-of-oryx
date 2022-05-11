<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Dependency\Service;

use Generated\Shared\Transfer\OrderTransfer;

interface JellyfishSalesOrderPayoneGiftCardConnectorToPayoneServiceInterface
{
    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\OrderTransfer
     */
    public function distributeOrderPrice(OrderTransfer $orderTransfer): OrderTransfer;
}
