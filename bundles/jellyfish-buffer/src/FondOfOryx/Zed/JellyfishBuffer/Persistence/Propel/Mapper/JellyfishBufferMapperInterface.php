<?php

namespace FondOfOryx\Zed\JellyfishBuffer\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Orm\Zed\JellyfishBuffer\Persistence\FooExportedOrder;

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
}
