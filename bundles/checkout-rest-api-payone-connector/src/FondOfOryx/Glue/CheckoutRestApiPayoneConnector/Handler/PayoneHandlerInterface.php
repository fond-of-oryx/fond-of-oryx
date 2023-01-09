<?php

namespace FondOfOryx\Glue\CheckoutRestApiPayoneConnector\Handler;

use Generated\Shared\Transfer\PaymentTransfer;
use Generated\Shared\Transfer\RestPaymentTransfer;

interface PayoneHandlerInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestPaymentTransfer $restPaymentTransfer
     *
     * @return \Generated\Shared\Transfer\PaymentTransfer
     */
    public function preparePayment(
        RestPaymentTransfer $restPaymentTransfer
    ): PaymentTransfer;
}
