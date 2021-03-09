<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApi\Dependency\Client;

use Generated\Shared\Transfer\RestCheckoutRequestAttributesTransfer;
use Generated\Shared\Transfer\RestCheckoutResponseTransfer;
use Spryker\Client\CheckoutRestApi\CheckoutRestApiClientInterface;

class SplittableCheckoutRestApiToCheckoutRestApiClientBridge implements SplittableCheckoutRestApiToCheckoutRestApiClientInterface
{
    /**
     * @var \Spryker\Client\CheckoutRestApi\CheckoutRestApiClientInterface
     */
    protected $checkoutRestApiClient;

    /**
     * @param \Spryker\Client\CheckoutRestApi\CheckoutRestApiClientInterface $checkoutRestApiClient
     */
    public function __construct(
        CheckoutRestApiClientInterface $checkoutRestApiClient
    ) {
        $this->checkoutRestApiClient = $checkoutRestApiClient;
    }

    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\RestCheckoutRequestAttributesTransfer $restCheckoutRequestAttributesTransfer
     * @return \Generated\Shared\Transfer\RestCheckoutResponseTransfer
     */
    public function placeOrder(
        RestCheckoutRequestAttributesTransfer $restCheckoutRequestAttributesTransfer
    ): RestCheckoutResponseTransfer {
        return $this->checkoutRestApiClient->placeOrder($restCheckoutRequestAttributesTransfer);
    }
}
