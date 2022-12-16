<?php

namespace FondOfOryx\Glue\PayoneRestApi\Plugin\CheckoutRestApi;

use FondOfOryx\Shared\PayoneRestApi\PayoneRestApiConstants;
use Generated\Shared\Transfer\RestCheckoutRequestAttributesTransfer;
use Spryker\Glue\CheckoutRestApiExtension\Dependency\Plugin\CheckoutRequestExpanderPluginInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\Kernel\AbstractPlugin;

/**
 * @method \FondOfOryx\Glue\PayoneRestApi\PayoneRestApiFactory getFactory()
 */
class PayoneRestApiCheckoutRequestExpanderPlugin extends AbstractPlugin implements CheckoutRequestExpanderPluginInterface
{
    public function expand(RestRequestInterface $restRequest, RestCheckoutRequestAttributesTransfer $restCheckoutRequestAttributesTransfer): RestCheckoutRequestAttributesTransfer
    {
        $payments = $restCheckoutRequestAttributesTransfer->getPayments();
        foreach ($payments as $restPayment){
            if (strtolower($restPayment->getPaymentProviderName()) === strtolower(PayoneRestApiConstants::PROVIDER_NAME)){
                $handler = $this->getFactory()->createPayoneHandler();
                $payment = $handler->preparePayment($restPayment, $restCheckoutRequestAttributesTransfer);
                $restPayment->setPayone($payment->getPayone())->setPaymentMethodName($payment->getPaymentMethod());
            }
        }
        return $restCheckoutRequestAttributesTransfer;
    }

}
