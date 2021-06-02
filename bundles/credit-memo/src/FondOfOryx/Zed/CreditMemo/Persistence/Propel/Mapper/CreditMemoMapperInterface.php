<?php

namespace FondOfOryx\Zed\CreditMemo\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\CreditMemoTransfer;
use Orm\Zed\CreditMemo\Persistence\FooCreditMemo;

interface CreditMemoMapperInterface
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
    ): FooCreditMemo;

    /**
     * @param \Orm\Zed\CreditMemo\Persistence\FooCreditMemo $fooCreditMemo
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Generated\Shared\Transfer\CreditMemoTransfer
     */
    public function mapEntityToTransfer(
        FooCreditMemo $fooCreditMemo,
        CreditMemoTransfer $creditMemoTransfer
    ): CreditMemoTransfer;
}
