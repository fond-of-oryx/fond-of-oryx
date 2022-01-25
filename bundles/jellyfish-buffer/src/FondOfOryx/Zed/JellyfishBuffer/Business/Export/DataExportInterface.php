<?php

namespace FondOfOryx\Zed\JellyfishBuffer\Business\Export;

use Generated\Shared\Transfer\ExportedOrderConfigTransfer;
use Generated\Shared\Transfer\ExportedOrderTransfer;

interface DataExportInterface
{
    /**
     * @param \Generated\Shared\Transfer\ExportedOrderTransfer $exportedOrderTransfer
     * @param \Generated\Shared\Transfer\ExportedOrderConfigTransfer $configTransfer
     *
     * @return bool
     */
    public function export(ExportedOrderTransfer $exportedOrderTransfer, ExportedOrderConfigTransfer $configTransfer): bool;

    /**
     * @param \Generated\Shared\Transfer\ExportedOrderConfigTransfer $configTransfer
     *
     * @return bool
     */
    public function exportByFilter(ExportedOrderConfigTransfer $configTransfer): bool;
}
