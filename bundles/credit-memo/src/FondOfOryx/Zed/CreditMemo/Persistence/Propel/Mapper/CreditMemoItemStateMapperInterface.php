<?php

namespace FondOfOryx\Zed\CreditMemo\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\CreditMemoItemStateTransfer;
use Orm\Zed\CreditMemo\Persistence\FooCreditMemoItemState;

interface CreditMemoItemStateMapperInterface
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
    ): FooCreditMemoItemState;

    /**
     * @param \Orm\Zed\CreditMemo\Persistence\FooCreditMemoItemState $fooCreditMemoItemState
     * @param \Generated\Shared\Transfer\CreditMemoItemStateTransfer $itemTransfer
     *
     * @return \Generated\Shared\Transfer\CreditMemoItemStateTransfer
     */
    public function mapEntityToTransfer(
        FooCreditMemoItemState $fooCreditMemoItemState,
        CreditMemoItemStateTransfer $itemTransfer
    ): CreditMemoItemStateTransfer;
}
