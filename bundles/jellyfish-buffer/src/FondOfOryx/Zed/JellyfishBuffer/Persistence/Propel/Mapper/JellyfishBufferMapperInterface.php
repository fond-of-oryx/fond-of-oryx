<?php

namespace FondOfOryx\Zed\JellyfishBuffer\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\ExportedOrderHistoryTransfer;
use Generated\Shared\Transfer\ExportedOrderTransfer;
use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Orm\Zed\JellyfishBuffer\Persistence\FooExportedOrder;
use Orm\Zed\JellyfishBuffer\Persistence\FooExportedOrderHistory;

interface JellyfishBufferMapperInterface
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
    ): FooExportedOrder;

    /**
     * @param \Orm\Zed\JellyfishBuffer\Persistence\FooExportedOrder $exportedOrder
     *
     * @return \Generated\Shared\Transfer\ExportedOrderTransfer
     */
    public function fromEntity(FooExportedOrder $exportedOrder): ExportedOrderTransfer;

    /**
     * @param \Orm\Zed\JellyfishBuffer\Persistence\FooExportedOrderHistory $exportedOrderHistory
     *
     * @return \Generated\Shared\Transfer\ExportedOrderHistoryTransfer
     */
    public function fromHistoryEntity(FooExportedOrderHistory $exportedOrderHistory): ExportedOrderHistoryTransfer;
}
