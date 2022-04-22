<?php

namespace FondOfOryx\Zed\CreditMemoGiftCardConnector\Business\Model;

use ArrayObject;
use Generated\Shared\Transfer\CreditMemoTransfer;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionTrait;

class CreditMemoGiftCardsWriter implements CreditMemoGiftCardsWriterInterface
{
    use TransactionTrait;

    /**
     * @var \FondOfOryx\Zed\CreditMemoGiftCardConnector\Business\Model\CreditMemoGiftCardWriterInterface
     */
    protected $giftCardWriter;

    /**
     * @param \FondOfOryx\Zed\CreditMemoGiftCardConnector\Business\Model\CreditMemoGiftCardWriterInterface $giftCardWriter
     */
    public function __construct(CreditMemoGiftCardWriterInterface $giftCardWriter)
    {
        $this->giftCardWriter = $giftCardWriter;
    }

    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Generated\Shared\Transfer\CreditMemoTransfer
     */
    public function create(
        CreditMemoTransfer $creditMemoTransfer
    ): CreditMemoTransfer {
        $giftCards = new ArrayObject();
        $idCreditMemo = $creditMemoTransfer->getIdCreditMemo();
        foreach ($creditMemoTransfer->getGiftCards() as $giftCard) {
            $giftCard->setFkCreditMemo($idCreditMemo);
            $giftCards->append($this->giftCardWriter->create($giftCard));
        }

        if ($giftCards->count() > 0) {
            $creditMemoTransfer->setGiftCards($giftCards);
        }

        return $creditMemoTransfer;
    }
}
