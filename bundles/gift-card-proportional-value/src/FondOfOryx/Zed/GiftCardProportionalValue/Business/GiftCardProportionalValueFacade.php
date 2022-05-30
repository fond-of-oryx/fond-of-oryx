<?php

namespace FondOfOryx\Zed\GiftCardProportionalValue\Business;

use Generated\Shared\Transfer\ProportionalGiftCardValueTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\GiftCardProportionalValue\Persistence\GiftCardProportionalValueEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\GiftCardProportionalValue\Persistence\GiftCardProportionalValueRepositoryInterface getRepository()()
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
}
