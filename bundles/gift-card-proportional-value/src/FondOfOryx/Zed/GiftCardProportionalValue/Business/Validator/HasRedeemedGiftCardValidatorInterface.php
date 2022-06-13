<?php

namespace FondOfOryx\Zed\GiftCardProportionalValue\Business\Validator;

use Orm\Zed\Sales\Persistence\SpySalesOrderItem;

interface HasRedeemedGiftCardValidatorInterface
{
    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItem $orderItem
     *
     * @return bool
     */
    public function validate(SpySalesOrderItem $orderItem): bool;
}
