<?php

namespace FondOfOryx\Zed\CreditMemo\Persistence;

use Generated\Shared\Transfer\CreditMemoTransfer;
use Generated\Shared\Transfer\ItemTransfer;

interface CreditMemoEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Generated\Shared\Transfer\CreditMemoTransfer
     */
    public function createCreditMemo(
        CreditMemoTransfer $creditMemoTransfer
    ): CreditMemoTransfer;

    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Generated\Shared\Transfer\CreditMemoTransfer
     */
    public function updateCreditMemo(
        CreditMemoTransfer $creditMemoTransfer
    ): CreditMemoTransfer;

    /**
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     *
     * @return \Generated\Shared\Transfer\ItemTransfer
     */
    public function createCreditMemoItem(
        ItemTransfer $itemTransfer
    ): ItemTransfer;
}
