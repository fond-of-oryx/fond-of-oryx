<?php

namespace FondOfOryx\Zed\GiftCardRestriction\Communication\Plugin\GiftCard;

use Generated\Shared\Transfer\GiftCardTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\GiftCard\Dependency\Plugin\GiftCardDecisionRulePluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\GiftCardRestriction\GiftCardRestrictionConfig getConfig()
 * @method \FondOfOryx\Zed\GiftCardRestriction\Business\GiftCardRestrictionFacadeInterface getFacade()
 */
class VoucherDiscountDecisionRulePlugin extends AbstractPlugin implements GiftCardDecisionRulePluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\GiftCardTransfer $giftCardTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return bool
     */
    public function isApplicable(GiftCardTransfer $giftCardTransfer, QuoteTransfer $quoteTransfer): bool
    {
        return $this->getFacade()->isVoucherDiscountDecisionRuleSatisfiedBy($giftCardTransfer, $quoteTransfer);
    }
}
