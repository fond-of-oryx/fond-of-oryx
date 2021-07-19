<?php

namespace FondOfOryx\Zed\GiftCardRestriction\Communication\Plugin\GiftCard;

use Generated\Shared\Transfer\GiftCardTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\GiftCard\Dependency\Plugin\GiftCardDecisionRulePluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\GiftCardRestriction\GiftCardRestrictionConfig getConfig()
 */
class VoucherIsUsedDecisionRulePlugin extends AbstractPlugin implements GiftCardDecisionRulePluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\GiftCardTransfer $giftCardTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return bool
     */
    public function isApplicable(GiftCardTransfer $giftCardTransfer, QuoteTransfer $quoteTransfer): bool
    {
        if ($quoteTransfer->getVoucherDiscounts()->count() === 0) {
            return true;
        }

        return $quoteTransfer->getVoucherDiscounts()->count() === 1
            && $quoteTransfer->getVoucherDiscounts()->offsetGet(0)->getVoucherCode() === $giftCardTransfer->getCode();
    }
}
