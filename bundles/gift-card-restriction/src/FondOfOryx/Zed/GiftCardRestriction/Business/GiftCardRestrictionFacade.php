<?php

namespace FondOfOryx\Zed\GiftCardRestriction\Business;

use Generated\Shared\Transfer\CalculableObjectTransfer;
use Generated\Shared\Transfer\GiftCardTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\GiftCardRestriction\Business\GiftCardRestrictionBusinessFactory getFactory()
 */
class GiftCardRestrictionFacade extends AbstractFacade implements GiftCardRestrictionFacadeInterface
{
    /**
     * {@inheritDoc}
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
    ): bool {
        return $this->getFactory()->createBlacklistedCountryDecisionRule()->isSatisfiedBy(
            $giftCardTransfer,
            $quoteTransfer
        );
    }

    /**
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
    ): bool {
        return $this->getFactory()->createVoucherDiscountDecisionRule()->isSatisfiedBy(
            $giftCardTransfer,
            $quoteTransfer
        );
    }

    /**
     * {@inheritDoc}
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
    ): bool {
        return $this->getFactory()->createBlacklistedCartCodeTypeDecisionRule()->isSatisfiedBy(
            $giftCardTransfer,
            $quoteTransfer
        );
    }

    /**
     * Specification:
     * - Prepares available amount of gift card payment method
     * - Excludes quote items that are blacklisted for cart code type "gift card"
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CalculableObjectTransfer $calculableObjectTransfer
     *
     * @return void
     */
    public function recalculate(CalculableObjectTransfer $calculableObjectTransfer): void
    {
        $this->getFactory()->createGiftCardRestrictionCalculator()->recalculate($calculableObjectTransfer);
    }
}
