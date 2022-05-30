<?php

namespace FondOfOryx\Zed\GiftCardProportionalValue\Persistence;

use Generated\Shared\Transfer\ProportionalGiftCardValueTransfer;
use Orm\Zed\GiftCardProportionalValue\Persistence\Map\FooProportionalGiftCardValueTableMap;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\GiftCardProportionalValue\Persistence\GiftCardProportionalValuePersistenceFactory getFactory()
 */
class GiftCardProportionalValueRepository extends AbstractRepository implements GiftCardProportionalValueRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProportionalGiftCardValueTransfer $proportionalGiftCardValueTransfer
     *
     * @return \Generated\Shared\Transfer\ProportionalGiftCardValueTransfer|null
     */
    public function findProportionalGiftCardValue(ProportionalGiftCardValueTransfer $proportionalGiftCardValueTransfer): ?ProportionalGiftCardValueTransfer
    {
        $proportionalGiftCardValueTransfer->requireSku()->requireValue()->requireOrderReference();

        $query = $this->getFactory()->createProportionalGiftCardValueQuery();
        $query
            ->filterBySku($proportionalGiftCardValueTransfer->getSku())
            ->filterByValue($proportionalGiftCardValueTransfer->getValue())
            ->filterByOrderreference($proportionalGiftCardValueTransfer->getOrderReference());

        $result = $query->findOne();

        return $result === null ? null : $this->getFactory()->createProportionalGiftCardValueMapper()->mapEntityToTransfer($result);
    }

    /**
     * @param int $idSalesOrderItem
     *
     * @return int|null
     */
    public function findGiftCardAmountByIdSalesOrderItem(int $idSalesOrderItem): ?int
    {
        $query = $this->getFactory()
            ->createProportionalGiftCardValueQuery();

        /** @var int|null $giftCardAmount */
        $giftCardAmount = $query->clear()
            ->select([FooProportionalGiftCardValueTableMap::COL_VALUE])
            ->filterByFkSalesOrderItem($idSalesOrderItem)
            ->findOne();

        return $giftCardAmount;
    }
}
