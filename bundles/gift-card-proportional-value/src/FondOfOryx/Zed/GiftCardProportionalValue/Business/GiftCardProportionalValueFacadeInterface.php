<?php

namespace FondOfOryx\Zed\GiftCardProportionalValue\Business;

use Generated\Shared\Transfer\ProportionalGiftCardValueTransfer;

interface GiftCardProportionalValueFacadeInterface
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

    /**
     * @param \Generated\Shared\Transfer\ProportionalGiftCardValueTransfer $proportionalGiftCardValueTransfer
     *
     * @return \Generated\Shared\Transfer\ProportionalGiftCardValueTransfer|null
     */
    public function findProportionalGiftCardValue(ProportionalGiftCardValueTransfer $proportionalGiftCardValueTransfer): ?ProportionalGiftCardValueTransfer;

    /**
     * @param int $idSalesOrderItem
     *
     * @return int|null
     */
    public function findGiftCardAmountByIdSalesOrderItem(int $idSalesOrderItem): ?int;
}
