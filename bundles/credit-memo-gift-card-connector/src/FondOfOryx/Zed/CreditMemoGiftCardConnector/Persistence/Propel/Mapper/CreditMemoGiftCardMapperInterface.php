<?php

namespace FondOfOryx\Zed\CreditMemoGiftCardConnector\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\CreditMemoGiftCardTransfer;
use Orm\Zed\CreditMemo\Persistence\FooCreditMemoGiftCard;

interface CreditMemoGiftCardMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\CreditMemoGiftCardTransfer $creditMemoGiftCardTransfer
     * @param \Orm\Zed\CreditMemo\Persistence\FooCreditMemoGiftCard $fooCreditMemoGiftCard
     *
     * @return \Orm\Zed\CreditMemo\Persistence\FooCreditMemoGiftCard
     */
    public function mapTransferToEntity(
        CreditMemoGiftCardTransfer $creditMemoGiftCardTransfer,
        FooCreditMemoGiftCard $fooCreditMemoGiftCard
    ): FooCreditMemoGiftCard;

    /**
     * @param \Orm\Zed\CreditMemo\Persistence\FooCreditMemoGiftCard $fooCreditMemoGiftCard
     * @param \Generated\Shared\Transfer\CreditMemoGiftCardTransfer $creditMemoGiftCardTransfer
     *
     * @return \Generated\Shared\Transfer\CreditMemoGiftCardTransfer
     */
    public function mapEntityToTransfer(
        FooCreditMemoGiftCard $fooCreditMemoGiftCard,
        CreditMemoGiftCardTransfer $creditMemoGiftCardTransfer
    ): CreditMemoGiftCardTransfer;
}
