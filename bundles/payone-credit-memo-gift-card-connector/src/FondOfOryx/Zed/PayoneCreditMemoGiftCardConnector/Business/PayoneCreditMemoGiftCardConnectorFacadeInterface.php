<?php

namespace FondOfOryx\Zed\PayoneCreditMemoGiftCardConnector\Business;

use Generated\Shared\Transfer\PayonePartialOperationRequestTransfer;
use Orm\Zed\CreditMemo\Persistence\FooCreditMemo;

interface PayoneCreditMemoGiftCardConnectorFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\PayonePartialOperationRequestTransfer $partialOperationRequestTransfer
     * @param \Orm\Zed\CreditMemo\Persistence\FooCreditMemo $creditMemoEntity
     *
     * @return \Generated\Shared\Transfer\PayonePartialOperationRequestTransfer
     */
    public function recalculateRefundAmounts(
        PayonePartialOperationRequestTransfer $partialOperationRequestTransfer,
        FooCreditMemo $creditMemoEntity
    ): PayonePartialOperationRequestTransfer;
}
