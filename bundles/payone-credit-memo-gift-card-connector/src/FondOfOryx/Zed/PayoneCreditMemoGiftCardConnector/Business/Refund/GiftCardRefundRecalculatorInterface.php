<?php

namespace FondOfOryx\Zed\PayoneCreditMemoGiftCardConnector\Business\Refund;

use Generated\Shared\Transfer\PayonePartialOperationRequestTransfer;
use Orm\Zed\CreditMemo\Persistence\FooCreditMemo;

interface GiftCardRefundRecalculatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\PayonePartialOperationRequestTransfer $partialOperationRequestTransfer
     * @param \Orm\Zed\CreditMemo\Persistence\FooCreditMemo $creditMemoEntity
     *
     * @return \Generated\Shared\Transfer\PayonePartialOperationRequestTransfer
     */
    public function recalculate(
        PayonePartialOperationRequestTransfer $partialOperationRequestTransfer,
        FooCreditMemo $creditMemoEntity
    ): PayonePartialOperationRequestTransfer;
}
