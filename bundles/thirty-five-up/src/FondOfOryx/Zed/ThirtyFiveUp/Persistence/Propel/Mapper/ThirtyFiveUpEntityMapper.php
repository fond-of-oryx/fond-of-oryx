<?php

namespace FondOfOryx\Zed\ThirtyFiveUp\Persistence\Propel\Mapper;

use DateTime;
use Exception;
use Generated\Shared\Transfer\ThirtyFiveUpOrderItemTransfer;
use Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer;
use Generated\Shared\Transfer\ThirtyFiveUpVendorTransfer;
use Orm\Zed\ThirtyFiveUp\Persistence\FooThirtyFiveUpOrder;
use Orm\Zed\ThirtyFiveUp\Persistence\FooThirtyFiveUpOrderItem;

class ThirtyFiveUpEntityMapper implements ThirtyFiveUpEntityMapperInterface
{
    /**
     * @param \Orm\Zed\ThirtyFiveUp\Persistence\FooThirtyFiveUpOrder $thirtyFiveUpOrder
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer
     */
    public function mapOrderFromEntity(FooThirtyFiveUpOrder $thirtyFiveUpOrder): ThirtyFiveUpOrderTransfer
    {
        $thirtyFiveUpOrderTransfer = new ThirtyFiveUpOrderTransfer();
        $thirtyFiveUpOrderTransfer
            ->fromArray($thirtyFiveUpOrder->toArray(), true)
            ->setId($thirtyFiveUpOrder->getIdThirtyFiveUpOrder())
            ->setCreatedAt($this->convertDateTimeToTimestamp($thirtyFiveUpOrder->getCreatedAt()))
            ->setUpdatedAt($this->convertDateTimeToTimestamp($thirtyFiveUpOrder->getUpdatedAt()))
            ->setIdSalesOrder($thirtyFiveUpOrder->getFkSalesOrder());

        foreach ($thirtyFiveUpOrder->getFooThirtyFiveUpOrderItems() as $orderItem) {
            $thirtyFiveUpOrderTransfer->addVendorItem($this->mapOrderItemFromEntity(
                $orderItem,
                $thirtyFiveUpOrderTransfer,
            ));
        }

        return $thirtyFiveUpOrderTransfer;
    }

    /**
     * @param \Orm\Zed\ThirtyFiveUp\Persistence\FooThirtyFiveUpOrderItem $orderItem
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpVendorTransfer
     */
    public function mapVendorFromEntity(FooThirtyFiveUpOrderItem $orderItem): ThirtyFiveUpVendorTransfer
    {
        $vendorTransfer = new ThirtyFiveUpVendorTransfer();
        $vendor = $orderItem->getFooThirtyFiveUpVendor();
        $vendorTransfer
            ->fromArray($vendor->toArray(), true)
            ->setId($vendor->getIdThirtyFiveUpVendor());

        return $vendorTransfer;
    }

    /**
     * @param \Orm\Zed\ThirtyFiveUp\Persistence\FooThirtyFiveUpOrderItem $orderItem
     * @param \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer $thirtyFiveUpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpOrderItemTransfer
     */
    public function mapOrderItemFromEntity(
        FooThirtyFiveUpOrderItem $orderItem,
        ThirtyFiveUpOrderTransfer $thirtyFiveUpOrderTransfer
    ): ThirtyFiveUpOrderItemTransfer {
        $orderItemTransfer = new ThirtyFiveUpOrderItemTransfer();
        $orderItemTransfer->fromArray($orderItem->toArray(), true);
        $orderItemTransfer
            ->setVendor($this->mapVendorFromEntity($orderItem))
            ->setId($orderItem->getIdThirtyFiveUpOrderItem())
            ->setCreatedAt($this->convertDateTimeToTimestamp($orderItem->getCreatedAt()))
            ->setUpdatedAt($this->convertDateTimeToTimestamp($orderItem->getUpdatedAt()))
            ->setIdThirtyFiveUpOrder($orderItem->getFkThirtyFiveUpOrder());

        return $orderItemTransfer;
    }

    /**
     * @param \DateTime|mixed|string|null $dateTime
     *
     * @throws \Exception
     *
     * @return int|null
     */
    protected function convertDateTimeToTimestamp($dateTime): ?int
    {
        if ($dateTime === null) {
            return null;
        }

        if ($dateTime instanceof DateTime) {
            return $dateTime->getTimestamp();
        }

        if (is_object($dateTime) === false && is_string($dateTime) === true) {
            return strtotime($dateTime);
        }

        throw new Exception('Could not convert DateTime to timestamp');
    }
}
