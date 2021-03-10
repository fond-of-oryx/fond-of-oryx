<?php

namespace FondOfOryx\Client\SplittableCheckoutRestApi;

use Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutResponseTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \FondOfOryx\Client\SplittableCheckoutRestApi\SplittableCheckoutRestApiFactory getFactory()
 */
class SplittableCheckoutRestApiClient extends AbstractClient implements SplittableCheckoutRestApiClientInterface
{
    /**
     * @api
     *
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer $restSplittableCheckoutRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestSplittableCheckoutResponseTransfer
     */
    public function placeOrder(
        RestSplittableCheckoutRequestAttributesTransfer $restSplittableCheckoutRequestAttributesTransfer
    ): RestSplittableCheckoutResponseTransfer {
        return $this->getFactory()
            ->createSplittableCheckoutRestApiZedStub()
            ->placeOrder($restSplittableCheckoutRequestAttributesTransfer);
    }
}
