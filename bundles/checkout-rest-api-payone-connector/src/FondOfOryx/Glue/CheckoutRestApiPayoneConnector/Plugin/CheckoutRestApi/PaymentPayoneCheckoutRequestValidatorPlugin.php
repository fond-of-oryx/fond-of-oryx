<?php

namespace FondOfOryx\Glue\CheckoutRestApiPayoneConnector\Plugin\CheckoutRestApi;

use Generated\Shared\Transfer\RestCheckoutRequestAttributesTransfer;
use Generated\Shared\Transfer\RestErrorCollectionTransfer;
use Spryker\Glue\CheckoutRestApiExtension\Dependency\Plugin\CheckoutRequestValidatorPluginInterface;
use SprykerEco\Shared\Payone\PayoneApiConstants;

/**
 * @method \FondOfOryx\Glue\CheckoutRestApiPayoneConnector\CheckoutRestApiPayoneConnectorFactory getFactory()
 */
class PaymentPayoneCheckoutRequestValidatorPlugin implements CheckoutRequestValidatorPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestCheckoutRequestAttributesTransfer $restCheckoutRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestErrorCollectionTransfer
     */
    public function validateAttributes(RestCheckoutRequestAttributesTransfer $restCheckoutRequestAttributesTransfer): RestErrorCollectionTransfer
    {
        $payments = $restCheckoutRequestAttributesTransfer->getPayments();
        foreach ($payments as $restPayment) {
            if (strtolower($restPayment->getPaymentProviderName()) !== strtolower(PayoneApiConstants::PROVIDER_NAME)) {
                continue;
            }
            $strategy = $this->getFactory()->getValidatorStrategy($restPayment->getPaymentSelection());
            if ($strategy !== null) {
                return $strategy->validate($restPayment);
            }
        }

        return new RestErrorCollectionTransfer();
    }
}
