<?php

namespace FondOfOryx\Zed\CreditMemo\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\ItemTransfer;
use Orm\Zed\CreditMemo\Persistence\FooCreditMemoItem;

class CreditMemoItemMapper implements CreditMemoItemMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     * @param \Orm\Zed\CreditMemo\Persistence\FooCreditMemoItem $fooCreditMemoItem
     *
     * @return \Orm\Zed\CreditMemo\Persistence\FooCreditMemoItem
     */
    public function mapTransferToEntity(
        ItemTransfer $itemTransfer,
        FooCreditMemoItem $fooCreditMemoItem
    ): FooCreditMemoItem {
        $fooCreditMemoItem->fromArray(
            $itemTransfer->modifiedToArray(false)
        );

        return $fooCreditMemoItem;
    }

    /**
     * @param \Orm\Zed\CreditMemo\Persistence\FooCreditMemoItem $fooCreditMemoItem
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     *
     * @return \Generated\Shared\Transfer\ItemTransfer
     */
    public function mapEntityToTransfer(
        FooCreditMemoItem $fooCreditMemoItem,
        ItemTransfer $itemTransfer
    ): ItemTransfer {
        return $itemTransfer->fromArray(
            $fooCreditMemoItem->toArray(),
            true
        );
    }
}
