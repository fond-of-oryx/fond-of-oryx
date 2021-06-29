<?php

namespace FondOfOryx\Zed\JellyfishSalesOrder\Business\Api\Adapter;

use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Psr\Http\Message\StreamInterface;

interface SalesOrderAdapterInterface
{
    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderTransfer $jellyfishOrderTransfer
     *
     * @return \Psr\Http\Message\StreamInterface|null
     */
    public function sendRequest(JellyfishOrderTransfer $jellyfishOrderTransfer): ?StreamInterface;
}
