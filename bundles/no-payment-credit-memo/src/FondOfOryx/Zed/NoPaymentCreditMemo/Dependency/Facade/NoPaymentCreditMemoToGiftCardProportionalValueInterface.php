<?php

namespace FondOfOryx\Zed\NoPaymentCreditMemo\Dependency\Facade;

use Generated\Shared\Transfer\ProportionalGiftCardValueTransfer;

interface NoPaymentCreditMemoToGiftCardProportionalValueInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProportionalGiftCardValueTransfer $proportionalGiftCardValueTransfer
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return \Generated\Shared\Transfer\ProportionalGiftCardValueTransfer
     */
    public function findOrCreateProportionalGiftCardValue(
        ProportionalGiftCardValueTransfer $proportionalGiftCardValueTransfer
    ): ProportionalGiftCardValueTransfer;
}
