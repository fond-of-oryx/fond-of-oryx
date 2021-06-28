<?php

namespace FondOfOryx\Zed\JellyfishCreditMemo\Business;

interface JellyfishCreditMemoFacadeInterface
{
    /**
     * @api
     * Specifications:
     * - Exports credit memos to jellyfish
     *
     * @return void
     */
    public function exportCreditMemos(): void;

    /**
     * @param int $salesOderId
     * @param int[] $salesOrderItemIds
     *
     * @return void
     */
    public function exportCreditMemo(int $salesOderId, array $salesOrderItemIds): void;
}
