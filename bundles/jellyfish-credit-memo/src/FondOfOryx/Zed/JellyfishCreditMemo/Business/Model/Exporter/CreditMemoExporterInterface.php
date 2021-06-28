<?php

namespace FondOfOryx\Zed\JellyfishCreditMemo\Business\Model\Exporter;

interface CreditMemoExporterInterface
{
    /**
     * Export credit memos
     */
    public function export(): void;

    /**
     * @param int $salesOrderId
     * @param array $salesOrderItemIds
     *
     * @return void
     */
    public function exportBySalesOrderIdAndSalesOrderItemIds(int $salesOrderId, array $salesOrderItemIds): void;
}
