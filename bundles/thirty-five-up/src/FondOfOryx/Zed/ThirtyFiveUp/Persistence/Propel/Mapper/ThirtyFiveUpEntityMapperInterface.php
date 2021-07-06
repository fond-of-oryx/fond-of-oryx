<?php

namespace FondOfOryx\Zed\ThirtyFiveUp\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\ThirtyFiveUpOrderItemTransfer;
use Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer;
use Generated\Shared\Transfer\ThirtyFiveUpVendorTransfer;
use Orm\Zed\ThirtyFiveUp\Persistence\FooThirtyFiveUpOrder;
use Orm\Zed\ThirtyFiveUp\Persistence\FooThirtyFiveUpOrderItem;

interface ThirtyFiveUpEntityMapperInterface
{
    /**
     * @param \Orm\Zed\ThirtyFiveUp\Persistence\FooThirtyFiveUpOrder $thirtyFiveUpOrder
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer
     */
    public function mapOrderFromEntity(FooThirtyFiveUpOrder $thirtyFiveUpOrder): ThirtyFiveUpOrderTransfer;

    /**
     * @param \Orm\Zed\ThirtyFiveUp\Persistence\FooThirtyFiveUpOrderItem $orderItem
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpVendorTransfer
     */
    public function mapVendorFromEntity(FooThirtyFiveUpOrderItem $orderItem): ThirtyFiveUpVendorTransfer;

    /**
     * @param \Orm\Zed\ThirtyFiveUp\Persistence\FooThirtyFiveUpOrderItem $orderItem
     * @param \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer $thirtyFiveUpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpOrderItemTransfer
     */
    public function mapOrderItemFromEntity(
        FooThirtyFiveUpOrderItem $orderItem,
        ThirtyFiveUpOrderTransfer $thirtyFiveUpOrderTransfer
    ): ThirtyFiveUpOrderItemTransfer;
}
