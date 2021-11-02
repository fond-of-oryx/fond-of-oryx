<?php

namespace FondOfOryx\Zed\GiftCardRestriction\Business\Calculator;

use FondOfOryx\Shared\GiftCardRestriction\GiftCardRestrictionConstants;
use FondOfOryx\Zed\GiftCardRestriction\Business\Filter\SkuFilterInterface;
use FondOfOryx\Zed\GiftCardRestriction\Dependency\Facade\GiftCardRestrictionToProductCartCodeTypeRestrictionFacadeInterface;
use Generated\Shared\Transfer\CalculableObjectTransfer;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\PaymentTransfer;
use Spryker\Zed\GiftCard\GiftCardConfig;

class GiftCardRestrictionCalculator implements GiftCardRestrictionCalculatorInterface
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
     * @param \Generated\Shared\Transfer\CalculableObjectTransfer $calculableObjectTransfer
     *
     * @return void
     */
    public function recalculate(CalculableObjectTransfer $calculableObjectTransfer): void
    {
        $paymentTransfer = $this->getGiftCardPaymentByCalculableObject($calculableObjectTransfer);

        if ($paymentTransfer === null) {
            return;
        }

        $availableAmount = 0;
        $skus = $this->skuFilter->filterFromItems($calculableObjectTransfer->getItems());
        $blacklistedCartCodeTypesPerSku = $this->productCartCodeTypeRestrictionFacade
            ->getBlacklistedCartCodeTypesByProductConcreteSkus($skus);

        foreach ($calculableObjectTransfer->getItems() as $itemTransfer) {
            if ($this->isItemBlacklistedForGiftCardPayment($itemTransfer, $blacklistedCartCodeTypesPerSku)) {
                continue;
            }

            $availableAmount += $itemTransfer->getSumPriceToPayAggregation();
        }

        if ($availableAmount >= $paymentTransfer->getAvailableAmount()) {
            return;
        }

        $paymentTransfer->setAvailableAmount($availableAmount);
    }

    /**
     * @param \Generated\Shared\Transfer\CalculableObjectTransfer $calculableObjectTransfer
     *
     * @return \Generated\Shared\Transfer\PaymentTransfer|null
     */
    protected function getGiftCardPaymentByCalculableObject(
        CalculableObjectTransfer $calculableObjectTransfer
    ): ?PaymentTransfer {
        foreach ($calculableObjectTransfer->getPayments() as $currentPaymentTransfer) {
            if ($currentPaymentTransfer->getPaymentProvider() !== GiftCardConfig::PROVIDER_NAME) {
                continue;
            }

            return $currentPaymentTransfer;
        }

        return null;
    }

    /**
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     * @param array $blacklistedCartCodeTypesPerSku
     *
     * @return bool
     */
    protected function isItemBlacklistedForGiftCardPayment(
        ItemTransfer $itemTransfer,
        array $blacklistedCartCodeTypesPerSku
    ): bool {
        $sku = $itemTransfer->getSku();

        return isset($blacklistedCartCodeTypesPerSku[$sku])
            && in_array(
                GiftCardRestrictionConstants::CART_CODE_TYPE_GIFT_CARD,
                $blacklistedCartCodeTypesPerSku[$sku],
                true,
            );
    }
}
