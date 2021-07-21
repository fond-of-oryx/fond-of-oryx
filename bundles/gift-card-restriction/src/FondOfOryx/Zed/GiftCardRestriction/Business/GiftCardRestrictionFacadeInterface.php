<?php

namespace FondOfOryx\Zed\GiftCardRestriction\Business;

use Generated\Shared\Transfer\GiftCardTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

interface GiftCardRestrictionFacadeInterface
{
    /**
     * Specifications:
     * - Checks if country of shipping address is blacklisted by config
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\GiftCardTransfer $giftCardTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return bool
     */
    public function isBlacklistedCountryDecisionRuleSatisfiedBy(
        GiftCardTransfer $giftCardTransfer,
        QuoteTransfer $quoteTransfer
    ): bool;

    /**
     * Specifications:
     * - Checks if a voucher is already in use
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\GiftCardTransfer $giftCardTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return bool
     */
    public function isVoucherDiscountDecisionRuleSatisfiedBy(
        GiftCardTransfer $giftCardTransfer,
        QuoteTransfer $quoteTransfer
    ): bool;

    /**
     * Specifications:
     * - Checks if all quote items are blacklisted for cart code type "gift card"
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\GiftCardTransfer $giftCardTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return bool
     */
    public function isBlacklistedCartCodeTypeDecisionRuleSatisfiedBy(
        GiftCardTransfer $giftCardTransfer,
        QuoteTransfer $quoteTransfer
    ): bool;
}
