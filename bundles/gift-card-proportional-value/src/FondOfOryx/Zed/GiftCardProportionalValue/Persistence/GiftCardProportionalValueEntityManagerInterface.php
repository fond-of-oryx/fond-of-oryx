<?php

namespace FondOfOryx\Zed\GiftCardProportionalValue\Persistence;

use Generated\Shared\Transfer\ProportionalGiftCardValueTransfer;

interface GiftCardProportionalValueEntityManagerInterface
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
