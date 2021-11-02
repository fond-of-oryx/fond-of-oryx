<?php

namespace FondOfOryx\Zed\CreditMemo\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\CreditMemoTransfer;
use Orm\Zed\CreditMemo\Persistence\FooCreditMemo;

class CreditMemoMapper implements CreditMemoMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     * @param \Orm\Zed\CreditMemo\Persistence\FooCreditMemo $fooCreditMemo
     *
     * @return \Orm\Zed\CreditMemo\Persistence\FooCreditMemo
     */
    public function mapTransferToEntity(
        CreditMemoTransfer $creditMemoTransfer,
        FooCreditMemo $fooCreditMemo
    ): FooCreditMemo {
        $fooCreditMemo->fromArray(
            $creditMemoTransfer->modifiedToArray(false),
        );

        if ($creditMemoTransfer->getLocale() !== null) {
            $fooCreditMemo->setFkLocale($creditMemoTransfer->getLocale()->getIdLocale());
        }

        return $fooCreditMemo;
    }

    /**
     * @param \Orm\Zed\CreditMemo\Persistence\FooCreditMemo $fooCreditMemo
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Generated\Shared\Transfer\CreditMemoTransfer
     */
    public function mapEntityToTransfer(
        FooCreditMemo $fooCreditMemo,
        CreditMemoTransfer $creditMemoTransfer
    ): CreditMemoTransfer {
        return $creditMemoTransfer->fromArray($fooCreditMemo->toArray(), true);
    }
}
