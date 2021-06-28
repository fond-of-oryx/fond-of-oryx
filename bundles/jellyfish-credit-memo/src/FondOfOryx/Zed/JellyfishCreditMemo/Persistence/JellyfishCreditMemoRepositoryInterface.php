<?php

namespace FondOfOryx\Zed\JellyfishCreditMemo\Persistence;

use Generated\Shared\Transfer\CreditMemoCollectionTransfer;
use Generated\Shared\Transfer\CreditMemoTransfer;
use Generated\Shared\Transfer\ItemStateTransfer;
use Generated\Shared\Transfer\ItemTransfer;

interface JellyfishCreditMemoRepositoryInterface
{
    /**
     * @return \Generated\Shared\Transfer\CreditMemoCollectionTransfer
     */
    public function findPendingCreditMemoCollection(): CreditMemoCollectionTransfer;

    /**
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     *
     * @return \Generated\Shared\Transfer\ItemStateTransfer|null
     */
    public function findSalesOrderItemStateByIdSalesOrderItem(ItemTransfer $itemTransfer): ?ItemStateTransfer;

    /**
     * @param int $salesOrderId
     * @param array $salesOrderItemIds
     *
     * @throws \Propel\Runtime\Exception\PropelException
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     *
     * @return \Generated\Shared\Transfer\CreditMemoTransfer|null
     */
    public function findCreditMemoBySalesOrderIdAndSalesOrderItemIds(int $salesOrderId, array $salesOrderItemIds): ?CreditMemoTransfer;

    /**
     * @param int $idSalesOrderItem
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return \Generated\Shared\Transfer\CreditMemoTransfer|null
     */
    public function findCreditMemoBySalesOrderItemId(int $idSalesOrderItem): ?CreditMemoTransfer;
}
