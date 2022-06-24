<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\Dependency\Facade;

use FondOfOryx\Zed\GiftCardProportionalValue\Business\GiftCardProportionalValueFacadeInterface;
use Generated\Shared\Transfer\ProportionalGiftCardValueTransfer;

class JellyfishSalesOrderGiftCardProportionalValueConnectorToGiftCardProportionalValueFacadeBridge implements JellyfishSalesOrderGiftCardProportionalValueConnectorToGiftCardProportionalValueFacadeInterface
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

    /**
     * @param int $idSalesOrderItem
     *
     * @return int|null
     */
    public function findGiftCardAmountByIdSalesOrderItem(int $idSalesOrderItem): ?int
    {
        return $this->facade->findGiftCardAmountByIdSalesOrderItem($idSalesOrderItem);
    }
}
