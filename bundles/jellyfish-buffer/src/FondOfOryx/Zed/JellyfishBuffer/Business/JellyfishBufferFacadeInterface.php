<?php

namespace FondOfOryx\Zed\JellyfishBuffer\Business;

use Generated\Shared\Transfer\JellyfishBufferTableFilterTransfer;
use Generated\Shared\Transfer\JellyfishOrderTransfer;

interface JellyfishBufferFacadeInterface
{
    /**
     * Specification:
     * - Stores a Jellyfish order in the database in a buffer table
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\JellyfishOrderTransfer $jellyfishOrderTransfer
     * @param array $options
     *
     * @return void
     */
    public function bufferOrder(
        JellyfishOrderTransfer $jellyfishOrderTransfer,
        array $options
    ): void;

    /**
     * @param \Generated\Shared\Transfer\JellyfishBufferTableFilterTransfer $jellyfishBufferTableFilterTransfer
     *
     * @return bool
     */
    public function exportFromBufferTable(JellyfishBufferTableFilterTransfer $jellyfishBufferTableFilterTransfer): bool;
}
