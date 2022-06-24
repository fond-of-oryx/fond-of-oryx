<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\Business\Expander;

use FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\Business\Reader\GiftCardProportionalValueReaderInterface;

class OrderItemsExpander implements OrderItemsExpanderInterface
{
    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\Business\Reader\GiftCardProportionalValueReaderInterface
     */
    protected $giftCardAmountReader;

    /**
     * @param \FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\Business\Reader\GiftCardProportionalValueReaderInterface $giftCardAmountReader
     */
    public function __construct(GiftCardProportionalValueReaderInterface $giftCardAmountReader)
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
