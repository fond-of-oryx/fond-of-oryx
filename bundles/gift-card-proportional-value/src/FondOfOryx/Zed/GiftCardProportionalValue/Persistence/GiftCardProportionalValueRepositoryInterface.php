<?php

namespace FondOfOryx\Zed\GiftCardProportionalValue\Persistence;

use Generated\Shared\Transfer\ProportionalGiftCardValueTransfer;

interface GiftCardProportionalValueRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProportionalGiftCardValueTransfer $proportionalGiftCardValueTransfer
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
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
