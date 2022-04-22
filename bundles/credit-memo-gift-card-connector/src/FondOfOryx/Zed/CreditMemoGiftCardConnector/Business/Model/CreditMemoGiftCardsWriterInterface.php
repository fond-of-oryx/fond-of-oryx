<?php

namespace FondOfOryx\Zed\CreditMemoGiftCardConnector\Business\Model;

use Generated\Shared\Transfer\CreditMemoTransfer;

interface CreditMemoGiftCardsWriterInterface
{
    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Generated\Shared\Transfer\CreditMemoTransfer
     */
    public function create(
        CreditMemoTransfer $creditMemoTransfer
    ): CreditMemoTransfer;
}
