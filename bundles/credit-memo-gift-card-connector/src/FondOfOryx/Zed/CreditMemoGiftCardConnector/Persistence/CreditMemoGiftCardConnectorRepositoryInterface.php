<?php

namespace FondOfOryx\Zed\CreditMemoGiftCardConnector\Persistence;

use Generated\Shared\Transfer\CreditMemoGiftCardTransfer;

interface CreditMemoGiftCardConnectorRepositoryInterface
{
    /**
     * @param int $fkGiftCard
     *
     * @return \Generated\Shared\Transfer\CreditMemoGiftCardTransfer|null
     */
    public function findCreditMemoGiftCardByFkGiftCard(int $fkGiftCard): ?CreditMemoGiftCardTransfer;

    /**
     * @param int $fkCreditMemo
     *
     * @return array<\Generated\Shared\Transfer\CreditMemoGiftCardTransfer>
     */
    public function findCreditMemoGiftCardsByFkCreditMemo(int $fkCreditMemo): array;
}
