<?php

namespace FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\Dependency\Service;

use Generated\Shared\Transfer\OrderTransfer;

interface GiftCardProportionalValuePayoneConnectorToPayoneServiceInterface
{
    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\OrderTransfer
     */
    public function distributeOrderPrice(OrderTransfer $orderTransfer): OrderTransfer;
}
