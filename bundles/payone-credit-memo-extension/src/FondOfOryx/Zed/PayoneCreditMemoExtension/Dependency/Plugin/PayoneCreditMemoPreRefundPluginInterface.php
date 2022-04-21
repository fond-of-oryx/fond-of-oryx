<?php

namespace FondOfOryx\Zed\PayoneCreditMemoExtension\Dependency\Plugin;

use Generated\Shared\Transfer\PayonePartialOperationRequestTransfer;
use Orm\Zed\CreditMemo\Persistence\FooCreditMemo;

interface PayoneCreditMemoPreRefundPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\PayonePartialOperationRequestTransfer $partialOperationRequestTransfer
     * @param \Orm\Zed\CreditMemo\Persistence\FooCreditMemo $creditMemoEntity
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return \Generated\Shared\Transfer\PayonePartialOperationRequestTransfer
     */
    public function execute(
        PayonePartialOperationRequestTransfer $partialOperationRequestTransfer,
        FooCreditMemo $creditMemoEntity
    ): PayonePartialOperationRequestTransfer;
}
