<?php

namespace FondOfOryx\Zed\JellyfishBuffer\Business\Export;

use Generated\Shared\Transfer\JellyfishBufferTableFilterTransfer;

interface DataExportInterface
{
    /**
     * @param \Generated\Shared\Transfer\JellyfishBufferTableFilterTransfer $jellyfishBufferTableFilterTransfer
     *
     * @return bool
     */
    public function export(JellyfishBufferTableFilterTransfer $jellyfishBufferTableFilterTransfer): bool;
}
