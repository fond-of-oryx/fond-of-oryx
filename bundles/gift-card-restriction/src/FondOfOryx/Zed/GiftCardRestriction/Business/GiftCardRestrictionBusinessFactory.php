<?php

namespace FondOfOryx\Zed\GiftCardRestriction\Business;

use FondOfOryx\Zed\GiftCardRestriction\Business\DecisionRule\BlacklistedCartCodeTypeDecisionRule;
use FondOfOryx\Zed\GiftCardRestriction\Business\DecisionRule\BlacklistedCountryDecisionRule;
use FondOfOryx\Zed\GiftCardRestriction\Business\DecisionRule\DecisionRuleInterface;
use FondOfOryx\Zed\GiftCardRestriction\Business\DecisionRule\VoucherDiscountDecisionRule;
use FondOfOryx\Zed\GiftCardRestriction\Dependency\Facade\GiftCardRestrictionToProductCartCodeTypeRestrictionFacadeInterface;
use FondOfOryx\Zed\GiftCardRestriction\GiftCardRestrictionDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\GiftCardRestriction\GiftCardRestrictionConfig getConfig()
 */
class GiftCardRestrictionBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\GiftCardRestriction\Business\DecisionRule\DecisionRuleInterface
     */
    public function createBlacklistedCountryDecisionRule(): DecisionRuleInterface
    {
        return new BlacklistedCountryDecisionRule($this->getConfig());
    }

    /**
     * @return \FondOfOryx\Zed\GiftCardRestriction\Business\DecisionRule\DecisionRuleInterface
     */
    public function createVoucherDiscountDecisionRule(): DecisionRuleInterface
    {
        return new VoucherDiscountDecisionRule();
    }

    /**
     * @return \FondOfOryx\Zed\GiftCardRestriction\Business\DecisionRule\DecisionRuleInterface
     */
    public function createBlacklistedCartCodeTypeDecisionRule(): DecisionRuleInterface
    {
        return new BlacklistedCartCodeTypeDecisionRule(
            $this->getProductCartCodeTypeRestrictionFacade()
        );
    }

    /**
     * @return \FondOfOryx\Zed\GiftCardRestriction\Dependency\Facade\GiftCardRestrictionToProductCartCodeTypeRestrictionFacadeInterface
     */
    protected function getProductCartCodeTypeRestrictionFacade(): GiftCardRestrictionToProductCartCodeTypeRestrictionFacadeInterface
    {
        return $this->getProvidedDependency(
            GiftCardRestrictionDependencyProvider::FACADE_PRODUCT_CART_CODE_TYPE_RESTRICTION
        );
    }
}
