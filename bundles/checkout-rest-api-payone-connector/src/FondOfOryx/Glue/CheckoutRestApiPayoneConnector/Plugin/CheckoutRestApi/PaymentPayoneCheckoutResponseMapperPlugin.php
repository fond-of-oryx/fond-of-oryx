<?php

namespace FondOfOryx\Glue\CheckoutRestApiPayoneConnector\Plugin\CheckoutRestApi;

use Generated\Shared\Transfer\RestCheckoutResponseAttributesTransfer;
use Generated\Shared\Transfer\RestCheckoutResponseTransfer;
use Spryker\Glue\CheckoutRestApiExtension\Dependency\Plugin\CheckoutResponseMapperPluginInterface;
use Spryker\Glue\Kernel\AbstractPlugin;

class PaymentPayoneCheckoutResponseMapperPlugin extends AbstractPlugin implements CheckoutResponseMapperPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestCheckoutResponseTransfer $restCheckoutResponseTransfer
     * @param \Generated\Shared\Transfer\RestCheckoutResponseAttributesTransfer $restCheckoutResponseAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestCheckoutResponseAttributesTransfer
     */
    public function mapRestCheckoutResponseTransferToRestCheckoutResponseAttributesTransfer(
        RestCheckoutResponseTransfer $restCheckoutResponseTransfer,
        RestCheckoutResponseAttributesTransfer $restCheckoutResponseAttributesTransfer
    ): RestCheckoutResponseAttributesTransfer {
        $restCheckoutResponseAttributesTransfer
            ->setIsExternalRedirect($restCheckoutResponseTransfer->getCheckoutResponse()->getIsExternalRedirect())
            ->setRedirectUrl($restCheckoutResponseTransfer->getCheckoutResponse()->getRedirectUrl());

        return $restCheckoutResponseAttributesTransfer;
    }
}
