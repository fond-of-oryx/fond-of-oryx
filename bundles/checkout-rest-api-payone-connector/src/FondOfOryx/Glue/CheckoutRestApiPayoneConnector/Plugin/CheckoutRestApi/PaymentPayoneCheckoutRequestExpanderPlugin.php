<?php

namespace FondOfOryx\Glue\CheckoutRestApiPayoneConnector\Plugin\CheckoutRestApi;

use Generated\Shared\Transfer\RestCheckoutRequestAttributesTransfer;
use Spryker\Glue\CheckoutRestApiExtension\Dependency\Plugin\CheckoutRequestExpanderPluginInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\Kernel\AbstractPlugin;
use SprykerEco\Shared\Payone\PayoneApiConstants;

/**
 * @method \FondOfOryx\Glue\CheckoutRestApiPayoneConnector\CheckoutRestApiPayoneConnectorFactory getFactory()
 */
class PaymentPayoneCheckoutRequestExpanderPlugin extends AbstractPlugin implements CheckoutRequestExpanderPluginInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestCheckoutRequestAttributesTransfer $restCheckoutRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestCheckoutRequestAttributesTransfer
     */
    public function expand(
        RestRequestInterface $restRequest,
        RestCheckoutRequestAttributesTransfer $restCheckoutRequestAttributesTransfer
    ): RestCheckoutRequestAttributesTransfer {
        $payments = $restCheckoutRequestAttributesTransfer->getPayments();
        foreach ($payments as $restPayment) {
            if (strtolower($restPayment->getPaymentProviderName()) !== strtolower(PayoneApiConstants::PROVIDER_NAME)) {
                continue;
            }

            $handler = $this->getFactory()->createPayoneHandler();
            $payment = $handler->preparePayment($restPayment);
            $restPayment->setPayone($payment->getPayone())->setPaymentMethodName($payment->getPaymentMethod());
        }

        return $restCheckoutRequestAttributesTransfer;
    }
}
