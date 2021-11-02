<?php

namespace FondOfOryx\Zed\CreditMemo\Business\Model;

use Exception;
use FondOfOryx\Zed\CreditMemo\Persistence\CreditMemoRepositoryInterface;

class CreditMemoReader implements CreditMemoReaderInterface
{
    /**
     * @var \FondOfOryx\Zed\CreditMemo\Persistence\CreditMemoRepositoryInterface
     */
    protected $creditMemoRepository;

    /**
     * @param \FondOfOryx\Zed\CreditMemo\Persistence\CreditMemoRepositoryInterface $creditMemoRepository
     */
    public function __construct(CreditMemoRepositoryInterface $creditMemoRepository)
    {
        $this->creditMemoRepository = $creditMemoRepository;
    }

    /**
     * @param array<\Orm\Zed\Sales\Persistence\SpySalesOrderItem> $spySalesOrderItems
     *
     * @throws \Exception
     *
     * @return array<\Orm\Zed\CreditMemo\Persistence\FooCreditMemo>
     */
    public function getCreditMemoBySalesOrderItems(array $spySalesOrderItems): array
    {
        $ids = [];
        $creditMemos = [];
        foreach ($spySalesOrderItems as $salesOrderItem) {
            $creditMemo = $this->creditMemoRepository->findCreditMemoByFkSalesOrderItem($salesOrderItem);

            if ($creditMemo === null) {
                $ids[] = $salesOrderItem->getIdSalesOrderItem();
            }

            if ($creditMemo !== null) {
                $creditMemos[$creditMemo->getCreditMemoReference()] = $creditMemo;
            }
        }

        if ($creditMemos === []) {
            throw new Exception(sprintf('No CreditMemo found for ids %s', implode(', ', $ids)));
        }

        return $creditMemos;
    }
}
