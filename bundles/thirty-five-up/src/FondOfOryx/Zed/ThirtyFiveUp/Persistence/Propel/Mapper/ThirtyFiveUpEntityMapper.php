<?php

namespace FondOfOryx\Zed\ThirtyFiveUp\Persistence\Propel\Mapper;

use DateTime;
use Generated\Shared\Transfer\ThirtyFiveUpOrderItemTransfer;
use Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer;
use Generated\Shared\Transfer\ThirtyFiveUpVendorTransfer;
use Orm\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpOrder;
use Orm\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpOrderItem;

class ThirtyFiveUpEntityMapper implements ThirtyFiveUpEntityMapperInterface
{
    /**
     * @param \Orm\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpOrder $thirtyFiveUpOrder
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer
     */
    public function mapOrderFromEntity(ThirtyFiveUpOrder $thirtyFiveUpOrder): ThirtyFiveUpOrderTransfer
    {
        $thirtyFiveUpOrderTransfer = new ThirtyFiveUpOrderTransfer();
        $thirtyFiveUpOrderTransfer
            ->fromArray($thirtyFiveUpOrder->toArray(), true)
            ->setId($thirtyFiveUpOrder->getIdThirtyFiveUpOrder())
            ->setCreatedAt($this->convertDateTimeToTimestamp($thirtyFiveUpOrder->getCreatedAt()))
            ->setUpdatedAt($this->convertDateTimeToTimestamp($thirtyFiveUpOrder->getUpdatedAt()))
            ->setIdSalesOrder($thirtyFiveUpOrder->getFkSalesOrder());

        foreach ($thirtyFiveUpOrder->getThirtyFiveUpOrderItems() as $orderItem) {
            $thirtyFiveUpOrderTransfer->addVendorItem($this->mapOrderItemFromEntity(
                $orderItem,
                $thirtyFiveUpOrderTransfer
            ));
        }

        return $thirtyFiveUpOrderTransfer;
    }

    /**
     * @param \Orm\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpOrderItem $orderItem
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpVendorTransfer
     */
    public function mapVendorFromEntity(ThirtyFiveUpOrderItem $orderItem): ThirtyFiveUpVendorTransfer
    {
        $vendorTransfer = new ThirtyFiveUpVendorTransfer();
        $vendor = $orderItem->getThirtyFiveUpVendor();
        $vendorTransfer
            ->fromArray($vendor->toArray(), true)
            ->setId($vendor->getIdThirtyFiveUpVendor());

        return $vendorTransfer;
    }

    /**
     * @param \Orm\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpOrderItem $orderItem
     * @param \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer $thirtyFiveUpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpOrderItemTransfer
     */
    public function mapOrderItemFromEntity(
        ThirtyFiveUpOrderItem $orderItem,
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
     * @param \DateTime|null $dateTime
     *
     * @return int|null
     */
    protected function convertDateTimeToTimestamp(?DateTime $dateTime): ?int
    {
        if ($dateTime instanceof DateTime) {
            return $dateTime->getTimestamp();
        }

        return null;
    }
}
