<?php

namespace FondOfOryx\Zed\GiftCardProportionalValueNoPaymentConnector\Business\Validator;

use Orm\Zed\Sales\Persistence\SpySalesOrder;

interface OnlyGiftCardPaymentValidatorInterface
{
    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $spySalesOrder
     *
     * @return bool
     */
    public function validate(SpySalesOrder $spySalesOrder): bool;
}
