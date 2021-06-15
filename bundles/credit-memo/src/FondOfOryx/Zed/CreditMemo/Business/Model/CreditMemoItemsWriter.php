<?php

namespace FondOfOryx\Zed\CreditMemo\Business\Model;

use FondOfOryx\Zed\CreditMemo\Persistence\CreditMemoEntityManagerInterface;
use Generated\Shared\Transfer\CreditMemoTransfer;

class CreditMemoItemsWriter implements CreditMemoItemsWriterInterface
{
    /**
     * @var \FondOfOryx\Zed\CreditMemo\Persistence\CreditMemoEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @param \FondOfOryx\Zed\CreditMemo\Persistence\CreditMemoEntityManagerInterface $entityManager
     */
    public function __construct(CreditMemoEntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Generated\Shared\Transfer\CreditMemoTransfer
     */
    public function create(
        CreditMemoTransfer $creditMemoTransfer
    ): CreditMemoTransfer {
        $creditMemoTransfer->requireIdCreditMemo();
        $creditMemoTransfer->requireItems();

        foreach ($creditMemoTransfer->getItems() as $creditMemoItemTransfer) {
            $this->entityManager->createCreditMemoItem(
                $creditMemoItemTransfer->setFkCreditMemo(
                    $creditMemoTransfer->getIdCreditMemo()
                )
            );
        }

        return $creditMemoTransfer;
    }
}
