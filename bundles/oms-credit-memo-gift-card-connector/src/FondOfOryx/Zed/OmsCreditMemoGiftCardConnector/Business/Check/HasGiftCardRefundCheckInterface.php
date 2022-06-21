<?php

namespace FondOfOryx\Zed\OmsCreditMemoGiftCardConnector\Business\Check;

interface HasGiftCardRefundCheckInterface
{
    /**
     * @param int $idSalesOrderItem
     *
     * @return bool
     */
    public function check(int $idSalesOrderItem): bool;
}
