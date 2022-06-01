<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderNoPaymentGiftCardConnector\Business\Validator;

use Generated\Shared\Transfer\JellyfishOrderTransfer;

interface OnlyGiftCardPaymentValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderTransfer $jellyfishOrderTransfer
     *
     * @return bool
     */
    public function isOnlyGiftCardPayment(JellyfishOrderTransfer $jellyfishOrderTransfer): bool;
}
