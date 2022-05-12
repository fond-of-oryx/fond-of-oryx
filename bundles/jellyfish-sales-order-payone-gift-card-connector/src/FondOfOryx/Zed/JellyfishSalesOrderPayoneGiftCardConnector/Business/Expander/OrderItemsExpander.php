<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\Expander;

use FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\Reader\GiftCardAmountReaderInterface;

class OrderItemsExpander implements OrderItemsExpanderInterface
{
    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\Reader\GiftCardAmountReaderInterface
     */
    protected $giftCardAmountReader;

    /**
     * @param \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\Reader\GiftCardAmountReaderInterface $giftCardAmountReader
     */
    public function __construct(GiftCardAmountReaderInterface $giftCardAmountReader)
    {
        $this->giftCardAmountReader = $giftCardAmountReader;
    }

    /**
     * @param array<\Generated\Shared\Transfer\ItemTransfer> $itemTransfers
     *
     * @return array<\Generated\Shared\Transfer\ItemTransfer>
     */
    public function expand(array $itemTransfers): array
    {
        foreach ($itemTransfers as $itemTransfer) {
            $giftCardAmount = $this->giftCardAmountReader->getByItemTransfer($itemTransfer);
            $itemTransfer->setGiftCardAmount($giftCardAmount);
        }

        return $itemTransfers;
    }
}
