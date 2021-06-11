<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApiOrderCustomReferenceConnector\Business\Expander;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer;

class QuoteExpander implements QuoteExpanderInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer $restSplittableCheckoutRequestTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function expand(
        RestSplittableCheckoutRequestTransfer $restSplittableCheckoutRequestTransfer,
        QuoteTransfer $quoteTransfer
    ): QuoteTransfer {
        $orderCustomReference = $restSplittableCheckoutRequestTransfer->getOrderCustomReference();

        if ($orderCustomReference === null || $orderCustomReference === '') {
            return $quoteTransfer;
        }

        $quoteTransfer->setOrderCustomReference($orderCustomReference);

        return $quoteTransfer->setOrderCustomReference($orderCustomReference);
    }
}
