<?php

namespace FondOfOryx\Zed\CreditMemoExtension\Dependency\Plugin;

use Generated\Shared\Transfer\CreditMemoTransfer;

interface CreditMemoPostSavePluginInterface
{
    /**
     * Specification:
     * - Plugin is triggered after credit memo object is saved.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Generated\Shared\Transfer\CreditMemoTransfer
     */
    public function postSave(CreditMemoTransfer $creditMemoTransfer): CreditMemoTransfer;
}
