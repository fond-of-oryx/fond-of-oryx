<?php

namespace FondOfOryx\Zed\SplittableCheckoutShipmentsRestApi\Business;

use FondOfOryx\Zed\SplittableCheckoutShipmentsRestApi\Business\SplittableCheckoutShipmentsRestApiFacadeInterface;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\SplittableCheckoutShipmentsRestApi\Business\SplittableCheckoutShipmentsRestApiBusinessFactory getFactory()
 */
class SplittableCheckoutShipmentsRestApiFacade extends AbstractFacade implements SplittableCheckoutShipmentsRestApiFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer $restSplittableCheckoutRequestAttributesTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function mapShipmentToQuote(
        RestSplittableCheckoutRequestAttributesTransfer $restSplittableCheckoutRequestAttributesTransfer,
        QuoteTransfer $quoteTransfer
    ): QuoteTransfer {
        return $this->getFactory()
            ->createShipmentQuoteMapper()
            ->mapShipmentToQuote($restSplittableCheckoutRequestAttributesTransfer, $quoteTransfer);
    }
}
