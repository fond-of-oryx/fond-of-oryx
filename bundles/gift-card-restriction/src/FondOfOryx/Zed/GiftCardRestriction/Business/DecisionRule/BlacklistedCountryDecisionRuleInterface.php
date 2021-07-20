<?php

namespace FondOfOryx\Zed\GiftCardRestriction\Business\DecisionRule;

use Generated\Shared\Transfer\QuoteTransfer;

interface BlacklistedCountryDecisionRuleInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return bool
     */
    public function isSatisfiedBy(QuoteTransfer $quoteTransfer): bool;
}
