<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\Validator;

use Generated\Shared\Transfer\JellyfishOrderTransfer;

interface IsPayonePaymentValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderTransfer $jellyfishOrderTransfer
     *
     * @return bool
     */
    public function isPayonePayment(JellyfishOrderTransfer $jellyfishOrderTransfer): bool;
}
