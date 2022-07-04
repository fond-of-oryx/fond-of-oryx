<?php

namespace FondOfOryx\Zed\CreditMemoPayoneDebitConnector\Business;

use Generated\Shared\Transfer\CreditMemoTransfer;

interface CreditMemoPayoneDebitConnectorFacadeInterface
{
    /**
     * Specification:
     * - Set is Debit value
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Generated\Shared\Transfer\CreditMemoTransfer
     */
    public function expandIsDebit(CreditMemoTransfer $creditMemoTransfer): CreditMemoTransfer;
}
