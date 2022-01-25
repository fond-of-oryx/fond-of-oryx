<?php

namespace FondOfOryx\Zed\JellyfishBuffer\Persistence;

use Generated\Shared\Transfer\ExportedOrderHistoryTransfer;
use Generated\Shared\Transfer\JellyfishOrderTransfer;

interface JellyfishBufferEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderTransfer $jellyfishOrderTransfer
     * @param array $options
     *
     * @return void
     */
    public function createExportedOrder(JellyfishOrderTransfer $jellyfishOrderTransfer, array $options): void;

    /**
     * @param int $fkSalesOrder
     *
     * @throws \Propel\Runtime\Exception\PropelException
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     *
     * @return void
     */
    public function flagAsReexported(int $fkSalesOrder): void;

    /**
     * @param \Generated\Shared\Transfer\ExportedOrderHistoryTransfer $exportedOrderHistoryTransfer
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return void
     */
    public function createHistoryEntry(ExportedOrderHistoryTransfer $exportedOrderHistoryTransfer): void;
}
