<?php

namespace FondOfOryx\Zed\CreditMemoPayoneDebitConnector\Business\Expander;

use Generated\Shared\Transfer\CreditMemoTransfer;

interface CreditMemoPayoneDebitConnectorIsDebitExpanderInterface
{
    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Generated\Shared\Transfer\CreditMemoTransfer
     */
    public function expandCreditMemo(CreditMemoTransfer $creditMemoTransfer): CreditMemoTransfer;
}
