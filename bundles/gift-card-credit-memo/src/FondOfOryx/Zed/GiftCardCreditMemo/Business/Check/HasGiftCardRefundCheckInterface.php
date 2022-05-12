<?php

namespace FondOfOryx\Zed\GiftCardCreditMemo\Business\Check;

interface HasGiftCardRefundCheckInterface
{
    /**
     * @param int $idSalesOrderItem
     *
     * @return bool
     */
    public function check(int $idSalesOrderItem): bool;
}
