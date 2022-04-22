<?php

namespace FondOfOryx\Zed\CreditMemoGiftCardConnector\Persistence;

use Generated\Shared\Transfer\CreditMemoGiftCardTransfer;

interface CreditMemoGiftCardConnectorEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\CreditMemoGiftCardTransfer $creditMemoGiftCardTransfer
     *
     * @return \Generated\Shared\Transfer\CreditMemoGiftCardTransfer
     */
    public function createCreditMemoGiftCard(
        CreditMemoGiftCardTransfer $creditMemoGiftCardTransfer
    ): CreditMemoGiftCardTransfer;
}
