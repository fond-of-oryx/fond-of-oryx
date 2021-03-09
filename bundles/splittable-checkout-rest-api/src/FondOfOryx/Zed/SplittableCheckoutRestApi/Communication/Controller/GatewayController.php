<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApi\Communication\Controller;

use Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutResponseTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method \FondOfOryx\Zed\SplittableCheckoutRestApi\Business\SplittableCheckoutRestApiFacadeInterface getFacade()
 */
class GatewayController extends AbstractGatewayController
{
    /**
     * @param \FondOfOryx\Zed\SplittableCheckoutRestApi\Communication\Controller\RestSplittableCheckoutRequestAttributesTransfer $restSplittableCheckoutRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestSplittableCheckoutResponseTransfer
     */
    public function placeOrderAction(
        RestSplittableCheckoutRequestAttributesTransfer $restSplittableCheckoutRequestAttributesTransfer
    ): RestSplittableCheckoutResponseTransfer {
        return $this->getFacade()->placeOrder($restSplittableCheckoutRequestAttributesTransfer);
    }
}
