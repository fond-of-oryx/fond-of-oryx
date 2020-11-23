<?php

namespace FondOfOryx\Zed\SalesLocaleConnector\Business;

use Generated\Shared\Transfer\OrderTransfer;

interface SalesLocaleConnectorFacadeInterface
{
    /**
     * Specifications:
     * - Expands order with locale information
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\OrderTransfer
     */
    public function expandOrder(OrderTransfer $orderTransfer): OrderTransfer;
}
