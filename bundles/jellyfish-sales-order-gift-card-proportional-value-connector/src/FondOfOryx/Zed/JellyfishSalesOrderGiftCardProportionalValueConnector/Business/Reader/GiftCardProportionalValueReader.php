<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\Business\Reader;

use FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\Dependency\Facade\JellyfishSalesOrderGiftCardProportionalValueConnectorToGiftCardProportionalValueFacadeInterface;
use Generated\Shared\Transfer\ItemTransfer;

class GiftCardProportionalValueReader implements GiftCardProportionalValueReaderInterface
{
    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\Dependency\Facade\JellyfishSalesOrderGiftCardProportionalValueConnectorToGiftCardProportionalValueFacadeInterface
     */
    protected $giftCardConnectorToGiftCardProportionalValueFacade;

    /**
     * @param \FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\Dependency\Facade\JellyfishSalesOrderGiftCardProportionalValueConnectorToGiftCardProportionalValueFacadeInterface $giftCardConnectorToGiftCardProportionalValueFacade
     */
    public function __construct(
        JellyfishSalesOrderGiftCardProportionalValueConnectorToGiftCardProportionalValueFacadeInterface $giftCardConnectorToGiftCardProportionalValueFacade
    ) {
        $this->giftCardConnectorToGiftCardProportionalValueFacade = $giftCardConnectorToGiftCardProportionalValueFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     *
     * @return int|null
     */
    public function getByItemTransfer(ItemTransfer $itemTransfer): ?int
    {
        $idSalesOrderItem = $itemTransfer->getIdSalesOrderItem();

        if ($idSalesOrderItem === null) {
            return null;
        }

        return $this->giftCardConnectorToGiftCardProportionalValueFacade->findGiftCardAmountByIdSalesOrderItem($idSalesOrderItem);
    }
}
