<?php

namespace FondOfOryx\Zed\GiftCardProportionalValue\Business;

use Generated\Shared\Transfer\ProportionalGiftCardValueTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem;
use Spryker\Zed\Kernel\Business\AbstractFacade;
use Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject;

/**
 * @method \FondOfOryx\Zed\GiftCardProportionalValue\Persistence\GiftCardProportionalValueEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\GiftCardProportionalValue\Persistence\GiftCardProportionalValueRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\GiftCardProportionalValue\Business\GiftCardProportionalValueBusinessFactory getFactory()
 */
class GiftCardProportionalValueFacade extends AbstractFacade implements GiftCardProportionalValueFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProportionalGiftCardValueTransfer $proportionalGiftCardValueTransfer
     *
     * @return \Generated\Shared\Transfer\ProportionalGiftCardValueTransfer
     */
    public function findOrCreateProportionalGiftCardValue(
        ProportionalGiftCardValueTransfer $proportionalGiftCardValueTransfer
    ): ProportionalGiftCardValueTransfer {
        return $this->getEntityManager()->findOrCreateProportionalGiftCardValue($proportionalGiftCardValueTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ProportionalGiftCardValueTransfer $proportionalGiftCardValueTransfer
     *
     * @return \Generated\Shared\Transfer\ProportionalGiftCardValueTransfer|null
     */
    public function findProportionalGiftCardValue(ProportionalGiftCardValueTransfer $proportionalGiftCardValueTransfer): ?ProportionalGiftCardValueTransfer
    {
        return $this->getRepository()->findProportionalGiftCardValue($proportionalGiftCardValueTransfer);
    }

    /**
     * @param int $idSalesOrderItem
     *
     * @return int|null
     */
    public function findGiftCardAmountByIdSalesOrderItem(int $idSalesOrderItem): ?int
    {
        return $this->getRepository()->findGiftCardAmountByIdSalesOrderItem($idSalesOrderItem);
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItem $orderItem
     *
     * @return bool
     */
    public function hasRedeemedGiftCards(SpySalesOrderItem $orderItem): bool
    {
        return $this->getFactory()->createHasRedeemedGiftCardValidator()->validate($orderItem);
    }

    /**
     * @param array<\Orm\Zed\Sales\Persistence\SpySalesOrderItem> $orderItems
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $orderEntity
     * @param \Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject $data
     *
     * @return array
     */
    public function createProportionalValues(array $orderItems, SpySalesOrder $orderEntity, ReadOnlyArrayObject $data): array
    {
        return $this->getFactory()->createManager()->createProportionalValues($orderItems, $orderEntity, $data);
    }
}
