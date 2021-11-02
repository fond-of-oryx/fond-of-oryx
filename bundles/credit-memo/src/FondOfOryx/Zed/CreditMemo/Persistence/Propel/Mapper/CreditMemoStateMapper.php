<?php

namespace FondOfOryx\Zed\CreditMemo\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\CreditMemoStateTransfer;
use Generated\Shared\Transfer\CreditMemoTransfer;
use Orm\Zed\CreditMemo\Persistence\FooCreditMemoState;

class CreditMemoStateMapper implements CreditMemoStateMapperInterface
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
    ): FooCreditMemoState {
        $fooCreditMemoState->fromArray(
            $creditMemoStateTransfer->modifiedToArray(false),
        );

        return $fooCreditMemoState;
    }

    /**
     * @param \Orm\Zed\CreditMemo\Persistence\FooCreditMemoState $fooCreditMemoState
     * @param \Generated\Shared\Transfer\CreditMemoStateTransfer $creditMemoStateTransfer
     *
     * @return \Generated\Shared\Transfer\CreditMemoStateTransfer
     */
    public function mapEntityToTransfer(
        FooCreditMemoState $fooCreditMemoState,
        CreditMemoStateTransfer $creditMemoStateTransfer
    ): CreditMemoStateTransfer {
        return $creditMemoStateTransfer->fromArray($fooCreditMemoState->toArray(), true);
    }

    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Generated\Shared\Transfer\CreditMemoStateTransfer
     */
    public function convertToStateTransfer(CreditMemoTransfer $creditMemoTransfer): CreditMemoStateTransfer
    {
        $stateTransfer = new CreditMemoStateTransfer();
        $stateTransfer->fromArray($creditMemoTransfer->toArray(), true);

        return $stateTransfer;
    }
}
