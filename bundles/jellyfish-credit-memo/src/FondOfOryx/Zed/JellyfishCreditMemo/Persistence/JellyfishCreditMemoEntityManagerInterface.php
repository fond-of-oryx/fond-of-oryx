<?php

namespace FondOfOryx\Zed\JellyfishCreditMemo\Persistence;

use Generated\Shared\Transfer\JellyfishCreditMemoTransfer;

interface JellyfishCreditMemoEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\JellyfishCreditMemoTransfer $jellyfishCreditMemoTransfer
     *
     * @return \Generated\Shared\Transfer\JellyfishCreditMemoTransfer
     */
    public function updateExportState(
        JellyfishCreditMemoTransfer $jellyfishCreditMemoTransfer
    ): JellyfishCreditMemoTransfer;
}
