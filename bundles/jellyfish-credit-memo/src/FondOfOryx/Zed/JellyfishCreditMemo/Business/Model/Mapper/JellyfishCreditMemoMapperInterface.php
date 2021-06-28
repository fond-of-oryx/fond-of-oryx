<?php

namespace FondOfOryx\Zed\JellyfishCreditMemo\Business\Model\Mapper;

use Generated\Shared\Transfer\CreditMemoTransfer;
use Generated\Shared\Transfer\JellyfishCreditMemoTransfer;

interface JellyfishCreditMemoMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Generated\Shared\Transfer\JellyfishCreditMemoTransfer
     */
    public function mapCreditMemoTransferToJellyfishCreditMemoTransfer(
        CreditMemoTransfer $creditMemoTransfer
    ): JellyfishCreditMemoTransfer;
}
