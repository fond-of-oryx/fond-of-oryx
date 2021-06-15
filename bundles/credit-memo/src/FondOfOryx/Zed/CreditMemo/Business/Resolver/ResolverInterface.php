<?php

namespace FondOfOryx\Zed\CreditMemo\Business\Resolver;

use Generated\Shared\Transfer\CreditMemoTransfer;

interface ResolverInterface
{
    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Generated\Shared\Transfer\CreditMemoTransfer
     */
    public function resolveAndAdd(CreditMemoTransfer $creditMemoTransfer): CreditMemoTransfer;
}
