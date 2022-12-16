<?php

namespace FondOfOryx\Zed\PayoneRestApi\Communication\Plugin\OrderPaymentsRestApi;

use Generated\Shared\Transfer\UpdateOrderPaymentRequestTransfer;
use Generated\Shared\Transfer\UpdateOrderPaymentResponseTransfer;
use Spryker\Zed\OrderPaymentsRestApiExtension\Dependency\Plugin\OrderPaymentUpdaterPluginInterface;

class PayoneRestApiOrderPaymentUpdaterPlugin implements OrderPaymentUpdaterPluginInterface
{
    public function isApplicable(UpdateOrderPaymentRequestTransfer $updateOrderPaymentRequestTransfer): bool
    {
        //toDo add correct check!
        return true;
    }

    public function updateOrderPayment(UpdateOrderPaymentRequestTransfer $updateOrderPaymentRequestTransfer): UpdateOrderPaymentResponseTransfer
    {
        //toDo add real logic
        return new UpdateOrderPaymentResponseTransfer();
    }

}
