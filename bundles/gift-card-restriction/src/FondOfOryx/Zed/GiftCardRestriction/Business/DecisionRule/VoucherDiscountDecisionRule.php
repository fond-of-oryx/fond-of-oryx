<?php

namespace FondOfOryx\Zed\GiftCardRestriction\Business\DecisionRule;

use Generated\Shared\Transfer\GiftCardTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class VoucherDiscountDecisionRule implements DecisionRuleInterface
{
    /**
     * @param \Generated\Shared\Transfer\GiftCardTransfer $giftCardTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return bool
     */
    public function isSatisfiedBy(GiftCardTransfer $giftCardTransfer, QuoteTransfer $quoteTransfer): bool
    {
        if ($quoteTransfer->getVoucherDiscounts()->count() === 0) {
            return true;
        }

        return $quoteTransfer->getVoucherDiscounts()->count() === 1
            && $quoteTransfer->getVoucherDiscounts()->offsetGet(0)->getVoucherCode() === $giftCardTransfer->getCode();
    }
}
