<?php

namespace FondOfOryx\Zed\CreditMemoGiftCardConnector\Business\Model;

use FondOfOryx\Zed\CreditMemoGiftCardConnector\Persistence\CreditMemoGiftCardConnectorEntityManagerInterface;
use Generated\Shared\Transfer\CreditMemoGiftCardTransfer;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionTrait;

class CreditMemoGiftCardWriter implements CreditMemoGiftCardWriterInterface
{
    use TransactionTrait;

    /**
     * @var \FondOfOryx\Zed\CreditMemoGiftCardConnector\Persistence\CreditMemoGiftCardConnectorEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @param \FondOfOryx\Zed\CreditMemoGiftCardConnector\Persistence\CreditMemoGiftCardConnectorEntityManagerInterface $entityManager
     */
    public function __construct(
        CreditMemoGiftCardConnectorEntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    /**
     * @param \Generated\Shared\Transfer\CreditMemoGiftCardTransfer $creditMemoGiftCardTransfer
     *
     * @return \Generated\Shared\Transfer\CreditMemoGiftCardTransfer
     */
    public function create(
        CreditMemoGiftCardTransfer $creditMemoGiftCardTransfer
    ): CreditMemoGiftCardTransfer {
        return $this->getTransactionHandler()->handleTransaction(
            function () use ($creditMemoGiftCardTransfer) {
                return $this->executeCreateTransaction($creditMemoGiftCardTransfer);
            },
        );
    }

    /**
     * @param \Generated\Shared\Transfer\CreditMemoGiftCardTransfer $creditMemoGiftCardTransfer
     *
     * @return \Generated\Shared\Transfer\CreditMemoGiftCardTransfer
     */
    protected function executeCreateTransaction(
        CreditMemoGiftCardTransfer $creditMemoGiftCardTransfer
    ): CreditMemoGiftCardTransfer {
        return $this->entityManager->createCreditMemoGiftCard($creditMemoGiftCardTransfer);
    }
}
