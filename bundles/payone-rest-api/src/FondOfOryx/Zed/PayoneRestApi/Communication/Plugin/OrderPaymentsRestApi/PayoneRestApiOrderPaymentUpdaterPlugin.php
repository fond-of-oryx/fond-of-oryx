<?php

namespace FondOfOryx\Zed\PayoneRestApi\Communication\Plugin\OrderPaymentsRestApi;

use Generated\Shared\Transfer\UpdateOrderPaymentRequestTransfer;
use Generated\Shared\Transfer\UpdateOrderPaymentResponseTransfer;
use Spryker\Zed\OrderPaymentsRestApiExtension\Dependency\Plugin\OrderPaymentUpdaterPluginInterface;

class PayoneRestApiOrderPaymentUpdaterPlugin implements OrderPaymentUpdaterPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\UpdateOrderPaymentRequestTransfer $updateOrderPaymentRequestTransfer
     *
     * @return bool
     */
    public function isApplicable(UpdateOrderPaymentRequestTransfer $updateOrderPaymentRequestTransfer): bool
    {
        //toDo add correct check!
        return true;
    }

    /**
     * @param \Generated\Shared\Transfer\UpdateOrderPaymentRequestTransfer $updateOrderPaymentRequestTransfer
     *
     * @return \Generated\Shared\Transfer\UpdateOrderPaymentResponseTransfer
     */
    public function updateOrderPayment(UpdateOrderPaymentRequestTransfer $updateOrderPaymentRequestTransfer): UpdateOrderPaymentResponseTransfer
    {
        //toDo add real logic
        return new UpdateOrderPaymentResponseTransfer();
    }
}
