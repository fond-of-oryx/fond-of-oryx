<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApiCartNoteConnector\Business\Expander;

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
        $cartNoteTransfer = $restSplittableCheckoutRequestTransfer->getCartNote();

        if ($cartNoteTransfer === null || $cartNoteTransfer->getMessage() === null) {
            return $quoteTransfer;
        }

        return $quoteTransfer->setCartNote($cartNoteTransfer->getMessage());
    }
}
