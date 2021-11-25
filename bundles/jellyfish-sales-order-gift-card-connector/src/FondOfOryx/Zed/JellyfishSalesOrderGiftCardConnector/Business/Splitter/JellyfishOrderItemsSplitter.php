<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Splitter;

use Generated\Shared\Transfer\JellyfishOrderItemTransfer;
use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem;

class JellyfishOrderItemsSplitter implements JellyfishOrderItemsSplitterInterface
{
    /**
     * @var string
     */
    protected const PRODUCT_TYPE_GIFT_CARD = 'gift_card';

    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderTransfer $jellyfishOrderTransfer
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $salesOrder
     *
     * @return \Generated\Shared\Transfer\JellyfishOrderTransfer
     */
    public function splitGiftCardOrderItems(
        JellyfishOrderTransfer $jellyfishOrderTransfer,
        SpySalesOrder $salesOrder
    ): JellyfishOrderTransfer {
        $giftCardItems = [];
        $items = $jellyfishOrderTransfer->getItems();

        foreach ($items as $item) {
            if ($this->shouldSplit($item) === false) {
                continue;
            }

            $giftCardItems = array_merge(
                $giftCardItems,
                $this->getSplittedGiftCardOrderItems($item, $salesOrder),
            );
        }

        foreach ($giftCardItems as $giftCardItem) {
            $items->append($giftCardItem);
        }

        return $jellyfishOrderTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderItemTransfer $jellyfishOrderItemTransfer
     *
     * @return bool
     */
    protected function shouldSplit(JellyfishOrderItemTransfer $jellyfishOrderItemTransfer): bool
    {
        return ($jellyfishOrderItemTransfer->getProductType() === static::PRODUCT_TYPE_GIFT_CARD
            && $jellyfishOrderItemTransfer->getQuantity() !== 1);
    }

    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderItemTransfer $jellyfishOrderItemTransfer
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $salesOrder
     *
     * @return array<\Generated\Shared\Transfer\JellyfishOrderItemTransfer>
     */
    protected function getSplittedGiftCardOrderItems(
        JellyfishOrderItemTransfer $jellyfishOrderItemTransfer,
        SpySalesOrder $salesOrder
    ): array {
        $splittedGiftCardItems = [];

        foreach ($salesOrder->getItems() as $item) {
            if ($jellyfishOrderItemTransfer->getSku() !== $item->getSku()) {
                continue;
            }

            if ($jellyfishOrderItemTransfer->getId() === $item->getIdSalesOrderItem()) {
                $jellyfishOrderItemTransfer = $this
                    ->mapJellyfishOrderItemTransferFromSalesOrder($jellyfishOrderItemTransfer, $item);

                continue;
            }

            $splittedGiftCardItems[] = $this->getSplittedGiftCardItem($jellyfishOrderItemTransfer, $item);
        }

        return $splittedGiftCardItems;
    }

    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderItemTransfer $jellyfishOrderItemTransfer
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItem $salesOrderItem
     *
     * @return \Generated\Shared\Transfer\JellyfishOrderItemTransfer
     */
    protected function getSplittedGiftCardItem(
        JellyfishOrderItemTransfer $jellyfishOrderItemTransfer,
        SpySalesOrderItem $salesOrderItem
    ): JellyfishOrderItemTransfer {
        $splitJellyfishOrderItemTransfer = (new JellyfishOrderItemTransfer())
            ->fromArray($jellyfishOrderItemTransfer->toArray(), true);

        $splitJellyfishOrderItemTransfer = $this
            ->mapJellyfishOrderItemTransferFromSalesOrder($splitJellyfishOrderItemTransfer, $salesOrderItem);

        return $splitJellyfishOrderItemTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderItemTransfer $jellyfishOrderItemTransfer
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItem $salesOrderItem
     *
     * @return \Generated\Shared\Transfer\JellyfishOrderItemTransfer
     */
    protected function mapJellyfishOrderItemTransferFromSalesOrder(
        JellyfishOrderItemTransfer $jellyfishOrderItemTransfer,
        SpySalesOrderItem $salesOrderItem
    ): JellyfishOrderItemTransfer {
        return $jellyfishOrderItemTransfer
            ->setId($salesOrderItem->getIdSalesOrderItem())
            ->setGiftCardCode($this->getGiftCardCode($salesOrderItem))
            ->setQuantity(1)
            ->setSumPrice($salesOrderItem->getPrice())
            ->setSumPriceToPayAggregation($salesOrderItem->getPriceToPayAggregation())
            ->setSumTaxAmount($salesOrderItem->getTaxAmount());
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItem $salesOrderItem
     *
     * @return string
     */
    protected function getGiftCardCode(SpySalesOrderItem $salesOrderItem): string
    {
        /** @var \Orm\Zed\Sales\Persistence\SpySalesOrderItemGiftCard $giftCard */
        $giftCard = $salesOrderItem
            ->getSpySalesOrderItemGiftCards()
            ->getFirst();

        return $giftCard->getCode();
    }
}
