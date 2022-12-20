<?php

namespace FondOfOryx\Glue\PayoneRestApi\Handler;

use Generated\Shared\Transfer\PaymentTransfer;
use Generated\Shared\Transfer\RestCheckoutRequestAttributesTransfer;
use Generated\Shared\Transfer\RestPaymentTransfer;

interface PayoneHandlerInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestPaymentTransfer $restPaymentTransfer
     * @param \Generated\Shared\Transfer\RestCheckoutRequestAttributesTransfer $restCheckoutRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\PaymentTransfer
     */
    public function preparePayment(
        RestPaymentTransfer $restPaymentTransfer,
        RestCheckoutRequestAttributesTransfer $restCheckoutRequestAttributesTransfer
    ): PaymentTransfer;
}
