<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApi\Business;

use Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutResponseTransfer;
use Generated\Shared\Transfer\RestSplittableTotalsResponseTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\SplittableCheckoutRestApi\Business\SplittableCheckoutRestApiBusinessFactory getFactory()
 */
class SplittableCheckoutRestApiFacade extends AbstractFacade implements SplittableCheckoutRestApiFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer $restSplittableCheckoutRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestSplittableCheckoutResponseTransfer
     */
    public function placeOrder(RestSplittableCheckoutRequestTransfer $restSplittableCheckoutRequestTransfer): RestSplittableCheckoutResponseTransfer
    {
        return $this->getFactory()
            ->createPlaceOrderProcessor()
            ->placeOrder($restSplittableCheckoutRequestTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer $restSplittableCheckoutRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestSplittableTotalsResponseTransfer
     */
    public function getSplittableTotals(
        RestSplittableCheckoutRequestTransfer $restSplittableCheckoutRequestTransfer
    ): RestSplittableTotalsResponseTransfer {
        return $this->getFactory()
            ->createSplittableTotalsReader()
            ->getByRestSplittableCheckoutRequest($restSplittableCheckoutRequestTransfer);
    }
}
