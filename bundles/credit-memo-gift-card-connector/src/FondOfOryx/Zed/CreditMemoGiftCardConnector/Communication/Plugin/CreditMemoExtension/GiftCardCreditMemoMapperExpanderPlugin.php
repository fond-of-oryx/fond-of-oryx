<?php

namespace FondOfOryx\Zed\CreditMemoGiftCardConnector\Communication\Plugin\CreditMemoExtension;

use ArrayObject;
use FondOfOryx\Zed\CreditMemoExtension\Persistence\Dependency\Plugin\CreditMemoMapperExpanderPluginInterface;
use Generated\Shared\Transfer\CreditMemoGiftCardTransfer;
use Generated\Shared\Transfer\CreditMemoTransfer;
use Orm\Zed\CreditMemo\Persistence\FooCreditMemo;

class GiftCardCreditMemoMapperExpanderPlugin implements CreditMemoMapperExpanderPluginInterface
{
    /**
     * @param \Orm\Zed\CreditMemo\Persistence\FooCreditMemo $fooCreditMemo
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Generated\Shared\Transfer\CreditMemoTransfer
     */
    public function expand(FooCreditMemo $fooCreditMemo, CreditMemoTransfer $creditMemoTransfer): CreditMemoTransfer
    {
        if ($fooCreditMemo->hasGiftCards() === false) {
            return $creditMemoTransfer;
        }

        $fooGiftCards = $fooCreditMemo->getFooCreditMemoGiftCards()->getData();
        $giftCards = new ArrayObject();
        foreach ($fooGiftCards as $fooGiftCard) {
            $giftCard = (new CreditMemoGiftCardTransfer())->fromArray($fooGiftCard->toArray(), true);
            $giftCards->append($giftCard);
        }

        return $creditMemoTransfer->setGiftCards($giftCards);
    }
}
