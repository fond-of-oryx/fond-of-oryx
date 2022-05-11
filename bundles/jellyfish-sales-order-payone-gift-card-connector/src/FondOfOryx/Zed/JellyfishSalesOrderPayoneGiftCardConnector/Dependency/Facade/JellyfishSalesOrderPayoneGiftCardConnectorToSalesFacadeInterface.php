<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Dependency\Facade;

use Generated\Shared\Transfer\OrderTransfer;

interface JellyfishSalesOrderPayoneGiftCardConnectorToSalesFacadeInterface
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
