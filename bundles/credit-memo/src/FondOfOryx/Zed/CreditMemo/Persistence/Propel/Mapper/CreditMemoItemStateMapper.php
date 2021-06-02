<?php

namespace FondOfOryx\Zed\CreditMemo\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\CreditMemoItemStateTransfer;
use Orm\Zed\CreditMemo\Persistence\FooCreditMemoItemState;

class CreditMemoItemStateMapper implements CreditMemoItemStateMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\CreditMemoItemStateTransfer $itemTransfer
     * @param \Orm\Zed\CreditMemo\Persistence\FooCreditMemoItemState $fooCreditMemoItemState
     *
     * @return \Orm\Zed\CreditMemo\Persistence\FooCreditMemoItemState
     */
    public function mapTransferToEntity(
        CreditMemoItemStateTransfer $itemTransfer,
        FooCreditMemoItemState $fooCreditMemoItemState
    ): FooCreditMemoItemState {
        $fooCreditMemoItemState->fromArray(
            $itemTransfer->modifiedToArray(false)
        );

        return $fooCreditMemoItemState;
    }

    /**
     * @param \Orm\Zed\CreditMemo\Persistence\FooCreditMemoItemState $fooCreditMemoItemState
     * @param \Generated\Shared\Transfer\CreditMemoItemStateTransfer $itemTransfer
     *
     * @return \Generated\Shared\Transfer\CreditMemoItemStateTransfer
     */
    public function mapEntityToTransfer(
        FooCreditMemoItemState $fooCreditMemoItemState,
        CreditMemoItemStateTransfer $itemTransfer
    ): CreditMemoItemStateTransfer {
        return $itemTransfer->fromArray(
            $fooCreditMemoItemState->toArray(),
            true
        );
    }
}
