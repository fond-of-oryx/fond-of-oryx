<?php

namespace FondOfOryx\Zed\CreditMemo\Persistence;

use Generated\Shared\Transfer\CreditMemoCollectionTransfer;
use Generated\Shared\Transfer\CreditMemoTransfer;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\SalesPaymentMethodTypeTransfer;
use Generated\Shared\Transfer\StoreTransfer;
use Orm\Zed\CreditMemo\Persistence\FooCreditMemo;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem;
use Propel\Runtime\Collection\ObjectCollection;

interface CreditMemoRepositoryInterface
{
    /**
     * @param int $idSalesOrderItem
     *
     * @return \Generated\Shared\Transfer\ItemTransfer|null
     */
    public function findCreditMemoItemByIdSalesOrderItem(int $idSalesOrderItem): ?ItemTransfer;

    /**
     * @param \Generated\Shared\Transfer\StoreTransfer $storeTransfer
     * @param int|null $limit
     * @param int|null $offset
     *
     * @return \Generated\Shared\Transfer\CreditMemoCollectionTransfer|null
     */
    public function findUnprocessedCreditMemoByStore(StoreTransfer $storeTransfer, ?int $limit = null, ?int $offset = null): ?CreditMemoCollectionTransfer;

    /**
     * @param int $idCreditMemo
     *
     * @return \Orm\Zed\CreditMemo\Persistence\FooCreditMemo|null
     */
    public function findCreditMemoById(int $idCreditMemo): ?FooCreditMemo;

    /**
     * @param int $idSalesOrder
     *
     * @return \Orm\Zed\CreditMemo\Persistence\FooCreditMemo[]
     */
    public function findCreditMemoByFkSalesOrder(int $idSalesOrder): array;

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItem $salesOrderItem
     *
     * @return \Orm\Zed\CreditMemo\Persistence\FooCreditMemo|null
     */
    public function findCreditMemoByFkSalesOrderItem(SpySalesOrderItem $salesOrderItem): ?FooCreditMemo;

    /**
     * @param \Generated\Shared\Transfer\StoreTransfer $storeTransfer
     * @param array $ids
     *
     * @return \Generated\Shared\Transfer\CreditMemoCollectionTransfer|null
     */
    public function findUnprocessedCreditMemoByStoreAndIds(StoreTransfer $storeTransfer, array $ids): ?CreditMemoCollectionTransfer;

    /**
     * @param int $idSalesOrder
     *
     * @throws \Propel\Runtime\Exception\PropelException
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     *
     * @return \Generated\Shared\Transfer\SalesPaymentMethodTypeTransfer|null
     */
    public function getSalesPaymentMethodType(int $idSalesOrder): ?SalesPaymentMethodTypeTransfer;

    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Propel\Runtime\Collection\ObjectCollection|null
     */
    public function getSalesOrderItemsByCreditMemo(CreditMemoTransfer $creditMemoTransfer): ?ObjectCollection;

    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrder|null
     */
    public function getSalesOrderByCreditMemo(CreditMemoTransfer $creditMemoTransfer): ?SpySalesOrder;
}
