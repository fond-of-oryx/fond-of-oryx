<?php

namespace FondOfOryx\Zed\CreditMemo\Business\Model;

use Generated\Shared\Transfer\CreditMemoTransfer;

interface CreditMemoPluginExecutorInterface
{
    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Generated\Shared\Transfer\CreditMemoTransfer
     */
    public function executePostSavePlugins(
        CreditMemoTransfer $creditMemoTransfer
    ): CreditMemoTransfer;

    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Generated\Shared\Transfer\CreditMemoTransfer
     */
    public function executePreSavePlugins(
        CreditMemoTransfer $creditMemoTransfer
    ): CreditMemoTransfer;
}
