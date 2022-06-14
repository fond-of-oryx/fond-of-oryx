<?php

namespace FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\Dependency\Facade;

use Generated\Shared\Transfer\OrderTransfer;

interface GiftCardProportionalValuePayoneConnectorToSalesFacadeInterface
{
    /**
     * @param int $idSalesOrder
     *
     * @throws \Spryker\Zed\Sales\Business\Exception\InvalidSalesOrderException
     *
     * @return \Generated\Shared\Transfer\OrderTransfer
     */
    public function getOrderByIdSalesOrder(int $idSalesOrder): OrderTransfer;
}
