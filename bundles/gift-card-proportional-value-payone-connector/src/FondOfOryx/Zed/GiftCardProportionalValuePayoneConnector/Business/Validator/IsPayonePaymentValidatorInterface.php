<?php

namespace FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\Business\Validator;

use Orm\Zed\Sales\Persistence\SpySalesOrder;

interface IsPayonePaymentValidatorInterface
{
    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $orderEntity
     *
     * @return bool
     */
    public function validate(SpySalesOrder $orderEntity): bool;
}
