<?php

namespace FondOfOryx\Zed\ThirtyFiveUp\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\ThirtyFiveUpOrderItemTransfer;
use Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer;
use Generated\Shared\Transfer\ThirtyFiveUpVendorTransfer;
use Orm\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpOrder;
use Orm\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpOrderItem;

interface ThirtyFiveUpEntityMapperInterface
{
    /**
     * @param \Orm\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpOrder $thirtyFiveUpOrder
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer
     */
    public function mapOrderFromEntity(ThirtyFiveUpOrder $thirtyFiveUpOrder): ThirtyFiveUpOrderTransfer;

    /**
     * @param \Orm\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpOrderItem $orderItem
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpVendorTransfer
     */
    public function mapVendorFromEntity(ThirtyFiveUpOrderItem $orderItem): ThirtyFiveUpVendorTransfer;

    /**
     * @param \Orm\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpOrderItem $orderItem
     * @param \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer $thirtyFiveUpOrderTransfer
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpOrderItemTransfer
     */
    public function mapOrderItemFromEntity(
        ThirtyFiveUpOrderItem $orderItem,
        ThirtyFiveUpOrderTransfer $thirtyFiveUpOrderTransfer
    ): ThirtyFiveUpOrderItemTransfer;
}
