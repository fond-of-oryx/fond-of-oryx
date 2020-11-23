<?php

namespace FondOfOryx\Zed\SalesLocaleConnector\Business\Model;

use Generated\Shared\Transfer\OrderTransfer;

interface OrderExpanderInterface
{
    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\OrderTransfer
     */
    public function expand(OrderTransfer $orderTransfer): OrderTransfer;
}
