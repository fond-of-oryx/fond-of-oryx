<?php

namespace FondOfOryx\Client\SplittableCheckoutRestApi\Zed;

use FondOfOryx\Client\SplittableCheckoutRestApi\Dependency\Client\SplittableCheckoutRestApiToZedRequestClientInterface;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutResponseTransfer;

class SplittableCheckoutRestApiZedStub implements SplittableCheckoutRestApiZedStubInterface
{
    /**
     * @var \FondOfOryx\Client\SplittableCheckoutRestApi\Dependency\Client\SplittableCheckoutRestApiToZedRequestClientInterface
     */
    protected $zedRequestClient;

    /**
     * @param \FondOfOryx\Client\SplittableCheckoutRestApi\Dependency\Client\SplittableCheckoutRestApiToZedRequestClientInterface $zedRequestClient
     */
    public function __construct(SplittableCheckoutRestApiToZedRequestClientInterface $zedRequestClient)
    {
        $this->zedRequestClient = $zedRequestClient;
    }

    /**
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer $restSplittableCheckoutRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestSplittableCheckoutResponseTransfer
     */
    public function placeOrder(
        RestSplittableCheckoutRequestAttributesTransfer $restSplittableCheckoutRequestAttributesTransfer
    ): RestSplittableCheckoutResponseTransfer {
        /** @var \Generated\Shared\Transfer\RestSplittableCheckoutResponseTransfer $restSplittableCheckoutResponseTransfer */
        $restSplittableCheckoutResponseTransfer = $this->zedRequestClient
            ->call('/splittable-checkout-rest-api/gateway/place-order', $restSplittableCheckoutRequestAttributesTransfer);

        return $restSplittableCheckoutResponseTransfer;
    }
}
