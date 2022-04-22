<?php

namespace FondOfOryx\Zed\CreditMemoGiftCardConnector\Persistence;

use Generated\Shared\Transfer\CreditMemoGiftCardTransfer;
use Orm\Zed\CreditMemo\Persistence\FooCreditMemoGiftCard;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \FondOfOryx\Zed\CreditMemoGiftCardConnector\Persistence\CreditMemoGiftCardConnectorPersistenceFactory getFactory()
 */
class CreditMemoGiftCardConnectorEntityManager extends AbstractEntityManager implements CreditMemoGiftCardConnectorEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\CreditMemoGiftCardTransfer $creditMemoGiftCardTransfer
     *
     * @return \Generated\Shared\Transfer\CreditMemoGiftCardTransfer
     */
    public function createCreditMemoGiftCard(
        CreditMemoGiftCardTransfer $creditMemoGiftCardTransfer
    ): CreditMemoGiftCardTransfer {
        $fooCreditMemoGiftCard = $this->getFactory()
            ->createCreditMemoGiftCardMapper()
            ->mapTransferToEntity($creditMemoGiftCardTransfer, new FooCreditMemoGiftCard());

        $fooCreditMemoGiftCard->save();

        return $this->getFactory()
            ->createCreditMemoGiftCardMapper()->mapEntityToTransfer($fooCreditMemoGiftCard, new CreditMemoGiftCardTransfer());
    }
}
