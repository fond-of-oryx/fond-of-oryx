<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApi\Business;

use Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutResponseTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\SplittableCheckoutRestApi\Business\SplittableCheckoutRestApiBusinessFactory getFactory()
 */
class SplittableCheckoutRestApiFacade extends AbstractFacade implements SplittableCheckoutRestApiFacadeInterface
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
        return $this->getFactory()->createPlaceOrderProcessor()->placeOrder($restSplittableCheckoutRequestAttributesTransfer);
    }
}
