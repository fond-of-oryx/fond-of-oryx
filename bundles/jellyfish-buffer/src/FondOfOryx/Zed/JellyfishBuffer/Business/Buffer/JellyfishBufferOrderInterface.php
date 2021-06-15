<?php

namespace FondOfOryx\Zed\JellyfishBuffer\Business\Buffer;

use Generated\Shared\Transfer\JellyfishOrderTransfer;

interface JellyfishBufferOrderInterface
{
    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderTransfer $jellyfishOrderTransfer
     * @param array $options
     *
     * @return void
     */
    public function bufferOrder(
        JellyfishOrderTransfer $jellyfishOrderTransfer,
        array $options
    ): void;
}
