<?php

namespace FondOfOryx\Zed\CreditMemoExtension\Dependency\Plugin;

use Generated\Shared\Transfer\CreditMemoTransfer;

interface CreditMemoPreSavePluginInterface
{
    /**
     * Specification:
     * - Plugin is triggered before credit memo object is saved.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Generated\Shared\Transfer\CreditMemoTransfer
     */
    public function preSave(
        CreditMemoTransfer $creditMemoTransfer
    ): CreditMemoTransfer;
}
