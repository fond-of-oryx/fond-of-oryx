<?php

namespace FondOfOryx\Zed\NoPaymentCreditMemo\Dependency\Facade;

use FondOfOryx\Zed\GiftCardProportionalValue\Business\GiftCardProportionalValueFacadeInterface;
use Generated\Shared\Transfer\ProportionalGiftCardValueTransfer;

class NoPaymentCreditMemoToGiftCardProportionalValueBridge implements NoPaymentCreditMemoToGiftCardProportionalValueInterface
{
    /**
     * @var \FondOfOryx\Zed\GiftCardProportionalValue\Business\GiftCardProportionalValueFacadeInterface
     */
    protected $facade;

    /**
     * @param \FondOfOryx\Zed\GiftCardProportionalValue\Business\GiftCardProportionalValueFacadeInterface $facade
     */
    public function __construct(GiftCardProportionalValueFacadeInterface $facade)
    {
        $this->facade = $facade;
    }

    /**
     * @param \Generated\Shared\Transfer\ProportionalGiftCardValueTransfer $proportionalGiftCardValueTransfer
     *
     * @return \Generated\Shared\Transfer\ProportionalGiftCardValueTransfer
     */
    public function findOrCreateProportionalGiftCardValue(
        ProportionalGiftCardValueTransfer $proportionalGiftCardValueTransfer
    ): ProportionalGiftCardValueTransfer {
        return $this->facade->findOrCreateProportionalGiftCardValue($proportionalGiftCardValueTransfer);
    }
}
