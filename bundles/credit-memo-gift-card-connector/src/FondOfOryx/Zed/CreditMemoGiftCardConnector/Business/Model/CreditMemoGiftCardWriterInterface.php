<?php

namespace FondOfOryx\Zed\CreditMemoGiftCardConnector\Business\Model;

use Generated\Shared\Transfer\CreditMemoGiftCardTransfer;

interface CreditMemoGiftCardWriterInterface
{
    /**
     * @param \Generated\Shared\Transfer\CreditMemoGiftCardTransfer $creditMemoTransfer
     *
     * @return \Generated\Shared\Transfer\CreditMemoGiftCardTransfer
     */
    public function create(
        CreditMemoGiftCardTransfer $creditMemoTransfer
    ): CreditMemoGiftCardTransfer;
}
