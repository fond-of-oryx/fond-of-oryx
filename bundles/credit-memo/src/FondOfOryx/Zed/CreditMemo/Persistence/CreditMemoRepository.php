<?php

namespace FondOfOryx\Zed\CreditMemo\Persistence;

use Generated\Shared\Transfer\CreditMemoCollectionTransfer;
use Generated\Shared\Transfer\CreditMemoQueryFilterTransfer;
use Generated\Shared\Transfer\CreditMemoTransfer;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\SalesPaymentMethodTypeTransfer;
use Generated\Shared\Transfer\StoreTransfer;
use Orm\Zed\CreditMemo\Persistence\FooCreditMemo;
use Orm\Zed\CreditMemo\Persistence\FooCreditMemoQuery;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem;
use Propel\Runtime\Collection\ObjectCollection;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\CreditMemo\Persistence\CreditMemoPersistenceFactory getFactory()
 */
class CreditMemoRepository extends AbstractRepository implements CreditMemoRepositoryInterface
{
    /**
     * @param int $idSalesOrderItem
     *
     * @return \Generated\Shared\Transfer\ItemTransfer|null
     */
    public function findCreditMemoItemByIdSalesOrderItem(int $idSalesOrderItem): ?ItemTransfer
    {
        $fooCreditMemoItemQuery = $this->getFactory()->createCreditMemoItemQuery();

        $fooCreditMemoItem = $fooCreditMemoItemQuery->filterByFkSalesOrderItem($idSalesOrderItem)
            ->findOne();

        if ($fooCreditMemoItem === null) {
            return null;
        }

        return $this->getFactory()->createCreditMemoItemMapper()->mapEntityToTransfer(
            $fooCreditMemoItem,
            new ItemTransfer(),
        );
    }

    /**
     * @param \Generated\Shared\Transfer\StoreTransfer $storeTransfer
     * @param int|null $limit
     * @param int|null $offset
     *
     * @return \Generated\Shared\Transfer\CreditMemoCollectionTransfer|null
     */
    public function findUnprocessedCreditMemoByStore(
        StoreTransfer $storeTransfer,
        ?int $limit = null,
        ?int $offset = null
    ): ?CreditMemoCollectionTransfer {
        $filter = new CreditMemoQueryFilterTransfer();
        $filter->setStoreName($storeTransfer->getName());

        $this->handleLimitAndOffset($limit, $offset, $filter);

        /** @var \Propel\Runtime\Collection\ObjectCollection $fooCreditMemos */
        $fooCreditMemos = $this->prepareFindUnprocessedCreditMemoQuery($filter)->find();

        return $this->prepareCreditMemoData($fooCreditMemos);
    }

    /**
     * @param \Generated\Shared\Transfer\StoreTransfer $storeTransfer
     * @param array $ids
     *
     * @return \Generated\Shared\Transfer\CreditMemoCollectionTransfer|null
     */
    public function findUnprocessedCreditMemoByStoreAndIds(
        StoreTransfer $storeTransfer,
        array $ids
    ): ?CreditMemoCollectionTransfer {
        $filter = new CreditMemoQueryFilterTransfer();
        $filter->setStoreName($storeTransfer->getName());
        $filter->setIds($ids);

        /** @var \Propel\Runtime\Collection\ObjectCollection $fooCreditMemos */
        $fooCreditMemos = $this->prepareFindUnprocessedCreditMemoQuery($filter)->find();

        return $this->prepareCreditMemoData($fooCreditMemos);
    }

    /**
     * @param int $idCreditMemo
     *
     * @return \Orm\Zed\CreditMemo\Persistence\FooCreditMemo|null
     */
    public function findCreditMemoById(int $idCreditMemo): ?FooCreditMemo
    {
        return $this->getFactory()->createCreditMemoQuery()->findOneByIdCreditMemo($idCreditMemo);
    }

    /**
     * @param int $idSalesOrder
     *
     * @return array<\Orm\Zed\CreditMemo\Persistence\FooCreditMemo>
     */
    public function findCreditMemoByFkSalesOrder(int $idSalesOrder): array
    {
        return $this->getFactory()->createCreditMemoQuery()->filterByFkSalesOrder($idSalesOrder)->find()->getData();
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItem $salesOrderItem
     *
     * @return \Orm\Zed\CreditMemo\Persistence\FooCreditMemo|null
     */
    public function findCreditMemoByFkSalesOrderItem(SpySalesOrderItem $salesOrderItem): ?FooCreditMemo
    {
        $creditMemoItem = $this->getFactory()->createCreditMemoItemQuery()->filterByFkSalesOrderItem($salesOrderItem->getIdSalesOrderItem())->findOne();

        if ($creditMemoItem === null) {
            return null;
        }

        return $creditMemoItem->getFooCreditMemo();
    }

    /**
     * @param int $idSalesOrder
     *
     * @return \Generated\Shared\Transfer\SalesPaymentMethodTypeTransfer|null
     */
    public function getSalesPaymentMethodType(int $idSalesOrder): ?SalesPaymentMethodTypeTransfer
    {
        $salesPayment = $this->getFactory()->getSpySalesPaymentQuery()->filterByFkSalesOrder($idSalesOrder)->findOne();

        if ($salesPayment === null) {
            return null;
        }

        return $this->getFactory()
            ->createCreditMemoSalesPaymentMethodTypeMapper()
            ->mapEntityToTransfer($salesPayment->getSalesPaymentMethodType(), new SalesPaymentMethodTypeTransfer());
    }

    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Propel\Runtime\Collection\ObjectCollection|null
     */
    public function getSalesOrderItemsByCreditMemo(CreditMemoTransfer $creditMemoTransfer): ?ObjectCollection
    {
        $itemIds = [];
        foreach ($creditMemoTransfer->getItems() as $itemTransfer) {
            $itemIds[] = $itemTransfer->getFkSalesOrderItem();
        }

        /** @var \Propel\Runtime\Collection\ObjectCollection $spySalesOrderItemCollection */
        $spySalesOrderItemCollection = $this->getFactory()
            ->getSpySalesOrderItemQuery()
            ->filterByIdSalesOrderItem_In($itemIds)
            ->find();

        return $spySalesOrderItemCollection;
    }

    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrder|null
     */
    public function getSalesOrderByCreditMemo(CreditMemoTransfer $creditMemoTransfer): ?SpySalesOrder
    {
        $creditMemoTransfer->requireFkSalesOrder();

        return $this->getFactory()->getSpySalesOrderQuery()->filterByIdSalesOrder($creditMemoTransfer->getFkSalesOrder())->findOne();
    }

    /**
     * @param \Generated\Shared\Transfer\CreditMemoQueryFilterTransfer $filterTransfer
     *
     * @return \Orm\Zed\CreditMemo\Persistence\FooCreditMemoQuery
     */
    protected function prepareFindUnprocessedCreditMemoQuery(CreditMemoQueryFilterTransfer $filterTransfer): FooCreditMemoQuery
    {
        $fooCreditMemoQuery = $this->getFactory()->createCreditMemoQuery();

        $fooCreditMemoQuery->filterByProcessed(false);
        $fooCreditMemoQuery->filterByInProgress(false);

        if ($filterTransfer->getStoreName() !== null) {
            $fooCreditMemoQuery->filterByStore($filterTransfer->getStoreName());
        }

        if ($filterTransfer->getIds() !== []) {
            $fooCreditMemoQuery->filterByIdCreditMemo_In($filterTransfer->getIds());
        }

        if ($filterTransfer->getLimit() !== null) {
            $fooCreditMemoQuery->limit($filterTransfer->getLimit());
        }

        if ($filterTransfer->getOffset() !== null) {
            $fooCreditMemoQuery->offset($filterTransfer->getOffset());
        }

        return $fooCreditMemoQuery;
    }

    /**
     * @param \Propel\Runtime\Collection\ObjectCollection $fooCreditMemoCollection
     *
     * @return \Generated\Shared\Transfer\CreditMemoCollectionTransfer
     */
    protected function prepareCreditMemoData(ObjectCollection $fooCreditMemoCollection): CreditMemoCollectionTransfer
    {
        $collection = new CreditMemoCollectionTransfer();

        /** @var \Orm\Zed\CreditMemo\Persistence\FooCreditMemo $creditMemo */
        foreach ($fooCreditMemoCollection->getData() as $creditMemo) {
            $collection->addCreditMemo($this->prepareCreditMemo($creditMemo));
        }

        return $collection;
    }

    /**
     * @param \Orm\Zed\CreditMemo\Persistence\FooCreditMemo $creditMemo
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return void
     */
    protected function prepareCreditMemoItems(
        FooCreditMemo $creditMemo,
        CreditMemoTransfer $creditMemoTransfer
    ): void {
        foreach ($creditMemo->getFooCreditMemoItems() as $creditMemoItem) {
            $creditMemoTransfer->addItem(
                $this->getFactory()->createCreditMemoItemMapper()->mapEntityToTransfer(
                    $creditMemoItem,
                    new ItemTransfer(),
                ),
            );
        }
    }

    /**
     * @param \Orm\Zed\CreditMemo\Persistence\FooCreditMemo $creditMemo
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return void
     */
    protected function prepareSalesPaymentMethodType(
        FooCreditMemo $creditMemo,
        CreditMemoTransfer $creditMemoTransfer
    ): void {
        $spySalesPaymentMethodType = $creditMemo->getSpySalesPaymentMethodType();

        if ($spySalesPaymentMethodType !== null) {
            $salesPaymentMethodTypeTransfer = $this->getFactory()
                ->createCreditMemoSalesPaymentMethodTypeMapper()
                ->mapEntityToTransfer($spySalesPaymentMethodType, new SalesPaymentMethodTypeTransfer());
            $creditMemoTransfer->setSalesPaymentMethodType($salesPaymentMethodTypeTransfer);
        }
    }

    /**
     * @param \Orm\Zed\CreditMemo\Persistence\FooCreditMemo $creditMemo
     *
     * @return \Generated\Shared\Transfer\CreditMemoTransfer
     */
    protected function prepareCreditMemo(FooCreditMemo $creditMemo): CreditMemoTransfer
    {
        $creditMemoTransfer = new CreditMemoTransfer();
        $creditMemoTransfer->fromArray($creditMemo->toArray(), true);

        $this->prepareCreditMemoItems($creditMemo, $creditMemoTransfer);
        $this->prepareSalesPaymentMethodType($creditMemo, $creditMemoTransfer);

        return $this->handleExpanderPlugins($creditMemo, $creditMemoTransfer);
    }

    /**
     * @param \Orm\Zed\CreditMemo\Persistence\FooCreditMemo $fooCreditMemo
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Generated\Shared\Transfer\CreditMemoTransfer
     */
    protected function handleExpanderPlugins(FooCreditMemo $fooCreditMemo, CreditMemoTransfer $creditMemoTransfer): CreditMemoTransfer
    {
        foreach ($this->getFactory()->getCreditMemoMapperExpanderPlugins() as $mapperExpanderPlugin) {
            $creditMemoTransfer = $mapperExpanderPlugin->expand($fooCreditMemo, $creditMemoTransfer);
        }

        return $creditMemoTransfer;
    }

    /**
     * @param int|null $limit
     * @param int|null $offset
     * @param \Generated\Shared\Transfer\CreditMemoQueryFilterTransfer $filter
     *
     * @return void
     */
    protected function handleLimitAndOffset(?int $limit, ?int $offset, CreditMemoQueryFilterTransfer $filter): void
    {
        if ($offset !== null) {
            $filter->setOffset($offset);
        }
        if ($limit !== null) {
            $filter->setLimit($limit);
        }

        if ($limit === null && $offset !== null) {
            $filter->setOffset(null);
        }
    }
}
