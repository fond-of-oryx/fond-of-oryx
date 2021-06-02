<?php

namespace FondOfOryx\Zed\CreditMemo\Business\Model;

use Generated\Shared\Transfer\CreditMemoTransfer;

interface CreditMemoItemsWriterInterface
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
