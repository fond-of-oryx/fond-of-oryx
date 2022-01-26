<?php

namespace FondOfOryx\Zed\JellyfishBufferGui\Dependency\Facade;

use Generated\Shared\Transfer\ExportedOrderCollectionTransfer;
use Generated\Shared\Transfer\ExportedOrderConfigTransfer;
use Generated\Shared\Transfer\ExportedOrderHistoryCollectionTransfer;
use Generated\Shared\Transfer\ExportedOrderTransfer;

interface JellyfishBufferGuiToJellyfishBufferInterface
{
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

    /**
     * @param \Generated\Shared\Transfer\ExportedOrderTransfer $exportedOrderTransfer
     * @param \Generated\Shared\Transfer\ExportedOrderConfigTransfer $configTransfer
     *
     * @return bool
     */
    public function export(ExportedOrderTransfer $exportedOrderTransfer, ExportedOrderConfigTransfer $configTransfer): bool;
}
