<?php

namespace FondOfOryx\Zed\JellyfishBuffer\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\ExportedOrderTransfer;
use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Orm\Zed\JellyfishBuffer\Persistence\FooExportedOrder;

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
            ->setData(json_encode($options));
    }

    /**
     * @param \Orm\Zed\JellyfishBuffer\Persistence\FooExportedOrder $exportedOrder
     *
     * @return \Generated\Shared\Transfer\ExportedOrderTransfer
     */
    public function fromEntity(FooExportedOrder $exportedOrder): ExportedOrderTransfer
    {
        return (new ExportedOrderTransfer())->fromArray($exportedOrder->toArray(), true);
    }
}
