<?php

namespace FondOfOryx\Zed\JellyfishBuffer\Persistence;

use Generated\Shared\Transfer\ExportedOrderCollectionTransfer;
use Generated\Shared\Transfer\JellyfishBufferTableFilterTransfer;

interface JellyfishBufferRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\JellyfishBufferTableFilterTransfer $jellyfishBufferTableFilterTransfer
     *
     * @return \Generated\Shared\Transfer\ExportedOrderCollectionTransfer
     */
    public function findBufferedOrders(JellyfishBufferTableFilterTransfer $jellyfishBufferTableFilterTransfer): ExportedOrderCollectionTransfer;
}
