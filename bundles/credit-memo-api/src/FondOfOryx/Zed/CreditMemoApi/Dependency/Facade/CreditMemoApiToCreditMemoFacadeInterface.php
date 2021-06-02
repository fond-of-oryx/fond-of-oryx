<?php

namespace FondOfOryx\Zed\CreditMemoApi\Dependency\Facade;

use Generated\Shared\Transfer\CreditMemoResponseTransfer;
use Generated\Shared\Transfer\CreditMemoTransfer;

interface CreditMemoApiToCreditMemoFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Generated\Shared\Transfer\CreditMemoResponseTransfer
     */
    public function createCreditMemo(
        CreditMemoTransfer $creditMemoTransfer
    ): CreditMemoResponseTransfer;
}
