<?php

namespace FondOfOryx\Zed\CreditMemoGiftCardConnector\Business;

use Generated\Shared\Transfer\CreditMemoTransfer;

interface CreditMemoGiftCardConnectorFacadeInterface
{
    /**
     * Specification:
     * - Creates credit memo gift cards
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Generated\Shared\Transfer\CreditMemoTransfer
     */
    public function createCreditMemoGiftCards(CreditMemoTransfer $creditMemoTransfer): CreditMemoTransfer;
}
