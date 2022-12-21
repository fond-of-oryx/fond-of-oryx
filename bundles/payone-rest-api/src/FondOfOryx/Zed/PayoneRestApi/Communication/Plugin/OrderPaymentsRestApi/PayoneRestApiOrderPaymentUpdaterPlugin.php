<?php

namespace FondOfOryx\Zed\PayoneRestApi\Communication\Plugin\OrderPaymentsRestApi;

use Generated\Shared\Transfer\UpdateOrderPaymentRequestTransfer;
use Generated\Shared\Transfer\UpdateOrderPaymentResponseTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\OrderPaymentsRestApiExtension\Dependency\Plugin\OrderPaymentUpdaterPluginInterface;
use SprykerEco\Shared\Payone\PayoneApiConstants;

class PayoneRestApiOrderPaymentUpdaterPlugin extends AbstractPlugin implements OrderPaymentUpdaterPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\UpdateOrderPaymentRequestTransfer $updateOrderPaymentRequestTransfer
     *
     * @return bool
     */
    public function isApplicable(UpdateOrderPaymentRequestTransfer $updateOrderPaymentRequestTransfer): bool
    {
        return strtolower($updateOrderPaymentRequestTransfer->getPaymentIdentifier()) === strtolower(PayoneApiConstants::PROVIDER_NAME);
    }

    /**
     * @param \Generated\Shared\Transfer\UpdateOrderPaymentRequestTransfer $updateOrderPaymentRequestTransfer
     *
     * @return \Generated\Shared\Transfer\UpdateOrderPaymentResponseTransfer
     */
    public function updateOrderPayment(UpdateOrderPaymentRequestTransfer $updateOrderPaymentRequestTransfer): UpdateOrderPaymentResponseTransfer
    {
        //ToDo: Maybe do some facade call for communication with payone

        return (new UpdateOrderPaymentResponseTransfer())
            ->setIsSuccessful(true)
            ->setPaymentIdentifier($updateOrderPaymentRequestTransfer->getPaymentIdentifier())
            ->setDataPayload($updateOrderPaymentRequestTransfer->getDataPayload());
    }
}
