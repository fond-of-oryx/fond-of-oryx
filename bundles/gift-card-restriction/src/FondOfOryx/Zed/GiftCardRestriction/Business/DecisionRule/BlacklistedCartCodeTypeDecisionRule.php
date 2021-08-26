<?php

namespace FondOfOryx\Zed\GiftCardRestriction\Business\DecisionRule;

use FondOfOryx\Shared\GiftCardRestriction\GiftCardRestrictionConstants;
use FondOfOryx\Zed\GiftCardRestriction\Business\Filter\SkuFilterInterface;
use FondOfOryx\Zed\GiftCardRestriction\Dependency\Facade\GiftCardRestrictionToProductCartCodeTypeRestrictionFacadeInterface;
use Generated\Shared\Transfer\GiftCardTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class BlacklistedCartCodeTypeDecisionRule implements DecisionRuleInterface
{
    /**
     * @var \FondOfOryx\Zed\GiftCardRestriction\Business\Filter\SkuFilterInterface
     */
    protected $skuFilter;

    /**
     * @var \FondOfOryx\Zed\GiftCardRestriction\Dependency\Facade\GiftCardRestrictionToProductCartCodeTypeRestrictionFacadeInterface
     */
    protected $productCartCodeTypeRestrictionFacade;

    /**
     * @param \FondOfOryx\Zed\GiftCardRestriction\Business\Filter\SkuFilterInterface $skuFilter
     * @param \FondOfOryx\Zed\GiftCardRestriction\Dependency\Facade\GiftCardRestrictionToProductCartCodeTypeRestrictionFacadeInterface $productCartCodeTypeRestrictionFacade
     */
    public function __construct(
        SkuFilterInterface $skuFilter,
        GiftCardRestrictionToProductCartCodeTypeRestrictionFacadeInterface $productCartCodeTypeRestrictionFacade
    ) {
        $this->skuFilter = $skuFilter;
        $this->productCartCodeTypeRestrictionFacade = $productCartCodeTypeRestrictionFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\GiftCardTransfer $giftCardTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return bool
     */
    public function isSatisfiedBy(GiftCardTransfer $giftCardTransfer, QuoteTransfer $quoteTransfer): bool
    {
        $skus = $this->skuFilter->filterFromItems($quoteTransfer->getItems());
        $blacklistedCartCodeTypesPerSku = $this->productCartCodeTypeRestrictionFacade
            ->getBlacklistedCartCodeTypesByProductConcreteSkus($skus);

        if (array_keys($blacklistedCartCodeTypesPerSku) != $skus) {
            return true;
        }

        foreach ($blacklistedCartCodeTypesPerSku as $blacklistedCartCodeTypes) {
            if (!in_array(GiftCardRestrictionConstants::CART_CODE_TYPE_GIFT_CARD, $blacklistedCartCodeTypes, true)) {
                return true;
            }
        }

        return false;
    }
}
