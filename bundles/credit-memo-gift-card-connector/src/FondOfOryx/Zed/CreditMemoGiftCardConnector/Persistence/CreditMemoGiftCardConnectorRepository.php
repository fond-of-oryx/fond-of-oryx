<?php

namespace FondOfOryx\Zed\CreditMemoGiftCardConnector\Persistence;

use Generated\Shared\Transfer\CreditMemoGiftCardTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\CreditMemoGiftCardConnector\Persistence\CreditMemoGiftCardConnectorPersistenceFactory getFactory()
 */
class CreditMemoGiftCardConnectorRepository extends AbstractRepository implements CreditMemoGiftCardConnectorRepositoryInterface
{
    /**
     * @param int $fkGiftCard
     *
     * @return \Generated\Shared\Transfer\CreditMemoGiftCardTransfer|null
     */
    public function findCreditMemoGiftCardByFkGiftCard(int $fkGiftCard): ?CreditMemoGiftCardTransfer
    {
        $fooCreditMemoGiftCardQuery = $this->getFactory()->createCreditMemoGiftCardQuery();

        $fooCreditMemoGiftCard = $fooCreditMemoGiftCardQuery->filterByFkGiftCard($fkGiftCard)
            ->findOne();

        if ($fooCreditMemoGiftCard === null) {
            return null;
        }

        return $this->getFactory()->createCreditMemoGiftCardMapper()->mapEntityToTransfer(
            $fooCreditMemoGiftCard,
            new CreditMemoGiftCardTransfer(),
        );
    }

    /**
     * @param int $fkCreditMemo
     *
     * @return array<\Generated\Shared\Transfer\CreditMemoGiftCardTransfer>
     */
    public function findCreditMemoGiftCardsByFkCreditMemo(int $fkCreditMemo): array
    {
        $fooCreditMemoGiftCardQuery = $this->getFactory()->createCreditMemoGiftCardQuery();

        $fooCreditMemoGiftCards = $fooCreditMemoGiftCardQuery->filterByFkCreditMemo($fkCreditMemo)->find();

        $giftCards = [];

        if (count($fooCreditMemoGiftCards->getData()) === 0) {
            return $giftCards;
        }

        foreach ($fooCreditMemoGiftCards->getData() as $giftCard) {
            $giftCards[] = $this->getFactory()->createCreditMemoGiftCardMapper()->mapEntityToTransfer(
                $giftCard,
                new CreditMemoGiftCardTransfer(),
            );
        }

        return $giftCards;
    }

    /**
     * @param int $idSalesOrderItem
     *
     * @return array<\Generated\Shared\Transfer\CreditMemoGiftCardTransfer>
     */
    public function findCreditMemoGiftCardsByIdSalesOrderItem(int $idSalesOrderItem): array
    {
        $fooCreditMemos = $this->getFactory()->getCreditMemoQuery()
            ->joinFooCreditMemoItem()
                ->useFooCreditMemoItemQuery()
                    ->filterByFkSalesOrderItem($idSalesOrderItem)
                ->endUse()
            ->joinWithFooCreditMemoGiftCard()
            ->find();

        $giftCards = [];

        if (count($fooCreditMemos->getData()) === 0) {
            return $giftCards;
        }

        /** @var \Orm\Zed\CreditMemo\Persistence\FooCreditMemo $fooCreditMemo */
        foreach ($fooCreditMemos->getData() as $fooCreditMemo) {
            if ($fooCreditMemo->hasGiftCards() === false) {
                continue;
            }
            $fooGiftCards = $fooCreditMemo->getFooCreditMemoGiftCards();
            foreach ($fooGiftCards as $giftCard) {
                $giftCards[] = $this->getFactory()->createCreditMemoGiftCardMapper()->mapEntityToTransfer(
                    $giftCard,
                    new CreditMemoGiftCardTransfer(),
                );
            }
        }

        return $giftCards;
    }
}
