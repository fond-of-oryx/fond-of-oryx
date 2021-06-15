<?php

namespace FondOfOryx\Zed\CreditMemo\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\CreditMemoStateTransfer;
use Generated\Shared\Transfer\CreditMemoTransfer;
use Orm\Zed\CreditMemo\Persistence\FooCreditMemoState;

interface CreditMemoStateMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\CreditMemoStateTransfer $creditMemoStateTransfer
     * @param \Orm\Zed\CreditMemo\Persistence\FooCreditMemoState $fooCreditMemoState
     *
     * @return \Orm\Zed\CreditMemo\Persistence\FooCreditMemoState
     */
    public function mapTransferToEntity(
        CreditMemoStateTransfer $creditMemoStateTransfer,
        FooCreditMemoState $fooCreditMemoState
    ): FooCreditMemoState;

    /**
     * @param \Orm\Zed\CreditMemo\Persistence\FooCreditMemoState $fooCreditMemoState
     * @param \Generated\Shared\Transfer\CreditMemoStateTransfer $creditMemoStateTransfer
     *
     * @return \Generated\Shared\Transfer\CreditMemoStateTransfer
     */
    public function mapEntityToTransfer(
        FooCreditMemoState $fooCreditMemoState,
        CreditMemoStateTransfer $creditMemoStateTransfer
    ): CreditMemoStateTransfer;

    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Generated\Shared\Transfer\CreditMemoStateTransfer
     */
    public function convertToStateTransfer(CreditMemoTransfer $creditMemoTransfer): CreditMemoStateTransfer;
}
