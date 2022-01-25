<?php

namespace FondOfOryx\Zed\JellyfishBuffer\Business;

use Generated\Shared\Transfer\ExportedOrderCollectionTransfer;
use Generated\Shared\Transfer\ExportedOrderConfigTransfer;
use Generated\Shared\Transfer\ExportedOrderHistoryCollectionTransfer;
use Generated\Shared\Transfer\ExportedOrderTransfer;
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
     * @param \Generated\Shared\Transfer\ExportedOrderConfigTransfer $configTransfer
     *
     * @return bool
     */
    public function exportFromBufferTable(ExportedOrderConfigTransfer $configTransfer): bool;

    /**
     * @param \Generated\Shared\Transfer\ExportedOrderTransfer $exportedOrderTransfer
     * @param \Generated\Shared\Transfer\ExportedOrderConfigTransfer $configTransfer
     *
     * @return bool
     */
    public function export(ExportedOrderTransfer $exportedOrderTransfer, ExportedOrderConfigTransfer $configTransfer): bool;

    /**
     * @param int $idExportedOrder
     *
     * @return \Generated\Shared\Transfer\ExportedOrderTransfer
     */
    public function getExportedOrderById(int $idExportedOrder): ExportedOrderTransfer;

    /**
     * @param int $fkSalesOrder
     *
     * @return \Generated\Shared\Transfer\ExportedOrderCollectionTransfer
     */
    public function findExportedOrdersByFkSalesOrder(int $fkSalesOrder): ExportedOrderCollectionTransfer;

    /**
     * @param int $idExportedOrder
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     *
     * @return \Generated\Shared\Transfer\ExportedOrderHistoryCollectionTransfer
     */
    public function findHistoryEntriesByIdExportedOrder(int $idExportedOrder): ExportedOrderHistoryCollectionTransfer;
}
