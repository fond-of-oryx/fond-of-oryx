<?php

namespace FondOfOryx\Zed\PayoneCreditMemo\Dependency\Facade;

use Generated\Shared\Transfer\OrderTransfer;

interface PayoneCreditMemoToSalesInterface
{
    /**
     * Specification:
     *  - Returns persisted order information for the given sales order id.
     *  - Hydrates order by calling HydrateOrderPlugin's registered in project dependency provider.
     *  - Hydrates order using quote level (BC) or item level shipping addresses.
     *
     * @api
     *
     * @param int $idSalesOrder
     *
     * @throws \Spryker\Zed\Sales\Business\Exception\InvalidSalesOrderException
     *
     * @return \Generated\Shared\Transfer\OrderTransfer
     */
    public function getOrderByIdSalesOrder($idSalesOrder): OrderTransfer;
}
