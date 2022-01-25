<?php

namespace FondOfOryx\Zed\JellyfishBuffer\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\ExportedOrderHistoryTransfer;
use Generated\Shared\Transfer\ExportedOrderTransfer;
use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Generated\Shared\Transfer\OrderTransfer;
use Generated\Shared\Transfer\UserTransfer;
use Orm\Zed\JellyfishBuffer\Persistence\FooExportedOrder;
use Orm\Zed\JellyfishBuffer\Persistence\FooExportedOrderHistory;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Orm\Zed\User\Persistence\SpyUser;

class JellyfishBufferMapper implements JellyfishBufferMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderTransfer $jellyfishOrderTransfer
     * @param array $options
     * @param \Orm\Zed\JellyfishBuffer\Persistence\FooExportedOrder $exportedOrder
     *
     * @return \Orm\Zed\JellyfishBuffer\Persistence\FooExportedOrder
     */
    public function mapTransferAndOptionsToEntity(
        JellyfishOrderTransfer $jellyfishOrderTransfer,
        array $options,
        FooExportedOrder $exportedOrder
    ): FooExportedOrder {
        return $exportedOrder->setFkSalesOrder($jellyfishOrderTransfer->getId())
            ->setOrderReference($jellyfishOrderTransfer->getReference())
            ->setStore($jellyfishOrderTransfer->getStore())
            ->setUpdatedAt(time())
            ->setData(json_encode($options));
    }

    /**
     * @param \Orm\Zed\JellyfishBuffer\Persistence\FooExportedOrder $exportedOrder
     *
     * @return \Generated\Shared\Transfer\ExportedOrderTransfer
     */
    public function fromEntity(FooExportedOrder $exportedOrder): ExportedOrderTransfer
    {
        return (new ExportedOrderTransfer())
            ->fromArray($exportedOrder->toArray(), true)
            ->setOrder($this->mapSalesOrder($exportedOrder->getOrder()));
    }

    /**
     * @param \Orm\Zed\JellyfishBuffer\Persistence\FooExportedOrderHistory $exportedOrderHistory
     *
     * @return \Generated\Shared\Transfer\ExportedOrderHistoryTransfer
     */
    public function fromHistoryEntity(FooExportedOrderHistory $exportedOrderHistory): ExportedOrderHistoryTransfer
    {
        return (new ExportedOrderHistoryTransfer())
            ->fromArray($exportedOrderHistory->toArray(), true)
            ->setUser($this->mapUser($exportedOrderHistory->getSpyUser()));
    }

    /**
     * @param \Orm\Zed\User\Persistence\SpyUser $spyUser
     *
     * @return \Generated\Shared\Transfer\UserTransfer
     */
    protected function mapUser(SpyUser $spyUser): UserTransfer
    {
        return (new UserTransfer())->fromArray($spyUser->toArray(), true);
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $spySalesOrder
     *
     * @return \Generated\Shared\Transfer\OrderTransfer
     */
    protected function mapSalesOrder(SpySalesOrder $spySalesOrder): OrderTransfer
    {
        return (new OrderTransfer())->fromArray($spySalesOrder->toArray(), true);
    }
}
