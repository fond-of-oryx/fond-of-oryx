<?php

namespace FondOfOryx\Zed\GiftCardRestriction\Business\DecisionRule;

use Generated\Shared\Transfer\GiftCardTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

interface DecisionRuleInterface
{
    /**
     * @param \Generated\Shared\Transfer\GiftCardTransfer $giftCardTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return bool
     */
    public function isSatisfiedBy(GiftCardTransfer $giftCardTransfer, QuoteTransfer $quoteTransfer): bool;
}
