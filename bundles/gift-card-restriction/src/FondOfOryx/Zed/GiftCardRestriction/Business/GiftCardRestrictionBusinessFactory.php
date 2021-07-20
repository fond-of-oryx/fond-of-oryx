<?php

namespace FondOfOryx\Zed\GiftCardRestriction\Business;

use FondOfOryx\Zed\GiftCardRestriction\Business\DecisionRule\BlacklistedCountryDecisionRule;
use FondOfOryx\Zed\GiftCardRestriction\Business\DecisionRule\BlacklistedCountryDecisionRuleInterface;
use FondOfOryx\Zed\GiftCardRestriction\Business\DecisionRule\VoucherDiscountDecisionRule;
use FondOfOryx\Zed\GiftCardRestriction\Business\DecisionRule\VoucherDiscountDecisionRuleInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\GiftCardRestriction\GiftCardRestrictionConfig getConfig()
 */
class GiftCardRestrictionBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\GiftCardRestriction\Business\DecisionRule\BlacklistedCountryDecisionRuleInterface
     */
    public function createBlacklistedCountryDecisionRule(): BlacklistedCountryDecisionRuleInterface
    {
        return new BlacklistedCountryDecisionRule($this->getConfig());
    }

    /**
     * @return \FondOfOryx\Zed\GiftCardRestriction\Business\DecisionRule\VoucherDiscountDecisionRuleInterface
     */
    public function createVoucherDiscountDecisionRule(): VoucherDiscountDecisionRuleInterface
    {
        return new VoucherDiscountDecisionRule();
    }
}
