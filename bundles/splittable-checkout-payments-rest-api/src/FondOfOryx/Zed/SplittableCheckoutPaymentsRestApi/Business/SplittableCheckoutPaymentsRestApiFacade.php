<?php

namespace FondOfSpryker\Zed\SplittableCheckoutPaymentsRestApi\Business;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\SplittableCheckoutPaymentsRestApi\Business\SplittableCheckoutPaymentsRestApiBusinessFactory getFactory()
 */
class PaymentsRestApiFacade extends AbstractFacade implements PaymentsRestApiFacadeInterface
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
    public function mapPaymentsToQuote(
        RestSplittableCheckoutRequestAttributesTransfer $restSplittableCheckoutRequestAttributesTransfer,
        QuoteTransfer $quoteTransfer
    ): QuoteTransfer {
        return $this->getFactory()
            ->createPaymentQuoteMapper()
            ->mapPaymentsToQuote($restSplittableCheckoutRequestAttributesTransfer, $quoteTransfer);
    }
}
