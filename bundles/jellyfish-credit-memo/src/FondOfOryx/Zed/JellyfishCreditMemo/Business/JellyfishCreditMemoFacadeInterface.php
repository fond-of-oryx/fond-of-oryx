<?php

namespace FondOfOryx\Zed\JellyfishCreditMemo\Business;

interface JellyfishCreditMemoFacadeInterface
{
    /**
     * Export Credit Memos To Jellyfish
     */
    public function exportCreditMemos(): void;

    /**
     * @param int $salesOderId
     * @param int[] $salesOrderItemIds
     */
    public function exportCreditMemo(int $salesOderId, array $salesOrderItemIds): void;
}
