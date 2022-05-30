<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\Reader;

use FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Dependency\Facade\JellyfishSalesOrderPayoneGiftCardConnectorToGiftCardProportionalValueFacadeInterface;
use Generated\Shared\Transfer\ItemTransfer;

class GiftCardAmountReader implements GiftCardAmountReaderInterface
{
    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Dependency\Facade\JellyfishSalesOrderPayoneGiftCardConnectorToGiftCardProportionalValueFacadeInterface
     */
    protected $giftCardConnectorToGiftCardProportionalValueFacade;

    /**
     * @param \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Dependency\Facade\JellyfishSalesOrderPayoneGiftCardConnectorToGiftCardProportionalValueFacadeInterface $giftCardConnectorToGiftCardProportionalValueFacade
     */
    public function __construct(
        JellyfishSalesOrderPayoneGiftCardConnectorToGiftCardProportionalValueFacadeInterface $giftCardConnectorToGiftCardProportionalValueFacade
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
