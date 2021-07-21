<?php

namespace FondOfOryx\Zed\GiftCardRestriction\Business\DecisionRule;

use ArrayObject;
use FondOfOryx\Shared\GiftCardRestriction\GiftCardRestrictionConstants;
use FondOfOryx\Zed\GiftCardRestriction\Dependency\Facade\GiftCardRestrictionToProductCartCodeTypeRestrictionFacadeInterface;
use Generated\Shared\Transfer\GiftCardTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class BlacklistedCartCodeTypeDecisionRule implements DecisionRuleInterface
{
    /**
     * @var \FondOfOryx\Zed\GiftCardRestriction\Dependency\Facade\GiftCardRestrictionToProductCartCodeTypeRestrictionFacadeInterface
     */
    protected $productCartCodeTypeRestrictionFacade;

    /**
     * @param \FondOfOryx\Zed\GiftCardRestriction\Dependency\Facade\GiftCardRestrictionToProductCartCodeTypeRestrictionFacadeInterface $productCartCodeTypeRestrictionFacade
     */
    public function __construct(GiftCardRestrictionToProductCartCodeTypeRestrictionFacadeInterface $productCartCodeTypeRestrictionFacade)
    {
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
        $skus = $this->getSkusByItems($quoteTransfer->getItems());
        $blacklistedCartCodeTypesPerSku = $this->productCartCodeTypeRestrictionFacade
            ->getBlacklistedCartCodeTypesByProductConcreteSkus($skus);

        foreach ($blacklistedCartCodeTypesPerSku as $blacklistedCartCodeTypes) {
            if (!in_array(GiftCardRestrictionConstants::CART_CODE_TYPE_GIFT_CARD, $blacklistedCartCodeTypes, true)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param \ArrayObject|\Generated\Shared\Transfer\ItemTransfer[] $itemTransfers
     *
     * @return string[]
     */
    protected function getSkusByItems(ArrayObject $itemTransfers): array
    {
        $skus = [];

        foreach ($itemTransfers as $itemTransfer) {
            $skus[] = $itemTransfer->getSku();
        }

        return $skus;
    }
}
