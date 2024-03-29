<?php

namespace FondOfOryx\Client\SplittableCheckoutRestApi\Zed;

use FondOfOryx\Client\SplittableCheckoutRestApi\Dependency\Client\SplittableCheckoutRestApiToZedRequestClientInterface;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutResponseTransfer;
use Generated\Shared\Transfer\RestSplittableTotalsResponseTransfer;

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
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer $restSplittableCheckoutRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestSplittableCheckoutResponseTransfer
     */
    public function placeOrder(
        RestSplittableCheckoutRequestTransfer $restSplittableCheckoutRequestTransfer
    ): RestSplittableCheckoutResponseTransfer {
        /** @var \Generated\Shared\Transfer\RestSplittableCheckoutResponseTransfer $restSplittableCheckoutResponseTransfer */
        $restSplittableCheckoutResponseTransfer = $this->zedRequestClient->call(
            '/splittable-checkout-rest-api/gateway/place-order',
            $restSplittableCheckoutRequestTransfer,
        );

        return $restSplittableCheckoutResponseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer $restSplittableCheckoutRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestSplittableTotalsResponseTransfer
     */
    public function getSplittableTotals(
        RestSplittableCheckoutRequestTransfer $restSplittableCheckoutRequestTransfer
    ): RestSplittableTotalsResponseTransfer {
        /** @var \Generated\Shared\Transfer\RestSplittableTotalsResponseTransfer $restSplittableTotalsResponseTransfer */
        $restSplittableTotalsResponseTransfer = $this->zedRequestClient->call(
            '/splittable-checkout-rest-api/gateway/get-splittable-totals',
            $restSplittableCheckoutRequestTransfer,
        );

        return $restSplittableTotalsResponseTransfer;
    }
}
