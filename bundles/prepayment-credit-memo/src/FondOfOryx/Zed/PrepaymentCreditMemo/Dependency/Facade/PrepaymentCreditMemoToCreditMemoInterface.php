<?php

namespace FondOfOryx\Zed\PrepaymentCreditMemo\Dependency\Facade;

use Generated\Shared\Transfer\CreditMemoResponseTransfer;
use Generated\Shared\Transfer\CreditMemoTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Propel\Runtime\Collection\ObjectCollection;

interface PrepaymentCreditMemoToCreditMemoInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Generated\Shared\Transfer\CreditMemoResponseTransfer
     */
    public function updateCreditMemo(CreditMemoTransfer $creditMemoTransfer): CreditMemoResponseTransfer;

    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrder
     */
    public function getSalesOrderByCreditMemo(CreditMemoTransfer $creditMemoTransfer): SpySalesOrder;

    /**
     * @param int $idSalesOrder
     *
     * @return \Orm\Zed\CreditMemo\Persistence\FooCreditMemo[]
     */
    public function getCreditMemoBySalesOrderId(int $idSalesOrder): array;

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItem[] $salesOrderItems
     *
     * @return \Orm\Zed\CreditMemo\Persistence\FooCreditMemo[]]
     */
    public function getCreditMemosBySalesOrderItems(array $salesOrderItems): array;

    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Propel\Runtime\Collection\ObjectCollection|null
     */
    public function getSalesOrderItemsByCreditMemo(CreditMemoTransfer $creditMemoTransfer): ?ObjectCollection;
}
