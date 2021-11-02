<?php

namespace FondOfOryx\Zed\JellyfishCreditMemo\Persistence;

use ArrayObject;
use Generated\Shared\Transfer\CreditMemoCollectionTransfer;
use Generated\Shared\Transfer\CreditMemoTransfer;
use Generated\Shared\Transfer\ItemStateTransfer;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\SpySalesOrderItemEntityTransfer;
use Orm\Zed\CreditMemo\Persistence\FooCreditMemo;
use Orm\Zed\CreditMemo\Persistence\FooCreditMemoItem;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\JellyfishCreditMemo\Persistence\JellyfishCreditMemoPersistenceFactory getFactory()
 */
class JellyfishCreditMemoRepository extends AbstractRepository implements JellyfishCreditMemoRepositoryInterface
{
    /**
     * @var string|null
     */
    protected const JELLYFISH_PENDING_EXPORT_STATE = null;

    /**
     * @var string
     */
    protected const FIELD_CREATED_AT = 'created_at';

    /**
     * @var string
     */
    protected const FIELD_UPDATED_AT = 'updated_at';

    /**
     * @return \Generated\Shared\Transfer\CreditMemoCollectionTransfer
     */
    public function findPendingCreditMemoCollection(): CreditMemoCollectionTransfer
    {
        $query = $this->getFactory()
            ->createCreditMemoQuery()
            ->leftJoinWithFooCreditMemoItem()
            ->leftJoinWithSpyLocale()
            ->filterByJellyfishExportState(static::JELLYFISH_PENDING_EXPORT_STATE);

        $entityTransferCollection = $this->buildQueryFromCriteria($query)->find();

        return $this->mapCreditMemoEntityTransferCollectionToCreditMemoCollectionTransfer($entityTransferCollection);
    }

    /**
     * @param int $salesOrderId
     * @param array $salesOrderItemIds
     *
     * @return \Generated\Shared\Transfer\CreditMemoTransfer|null
     */
    public function findCreditMemoBySalesOrderIdAndSalesOrderItemIds(
        int $salesOrderId,
        array $salesOrderItemIds
    ): ?CreditMemoTransfer {
        $query = $this->getFactory()
            ->createCreditMemoQuery()
            ->useFooCreditMemoItemQuery()->filterByFkSalesOrderItem_In($salesOrderItemIds)
            ->endUse()
            ->filterByFkSalesOrder($salesOrderId);

        $results = $query->find();

        if (empty($results) || empty($results->getData())) {
            return null;
        }

        /** @var \Orm\Zed\CreditMemo\Persistence\FooCreditMemo $fooCreditMemo */
        foreach ($results->getData() as $fooCreditMemo) {
            $items = $fooCreditMemo->getFooCreditMemoItems();
            if (count($items) === count($salesOrderItemIds)) {
                $found = true;
                foreach ($items as $creditMemoItem) {
                    if (in_array($creditMemoItem->getFkSalesOrderItem(), $salesOrderItemIds) === false) {
                        $found = false;

                        break;
                    }
                }
                if ($found === true) {
                    return $this->mapCreditMemoEntityToCreditMemoTransfer($fooCreditMemo);
                }
            }
        }

        return null;
    }

    /**
     * @param int $idSalesOrderItem
     *
     * @return \Generated\Shared\Transfer\CreditMemoTransfer|null
     */
    public function findCreditMemoBySalesOrderItemId(int $idSalesOrderItem): ?CreditMemoTransfer
    {
        $item = $this->getFactory()->createCreditMemoQuery()->useFooCreditMemoItemQuery()->findOneByFkSalesOrderItem($idSalesOrderItem);

        if ($item === null) {
            return null;
        }

        $fooCreditMemo = $this->getFactory()->createCreditMemoQuery()->findOneByIdCreditMemo($item->getFkCreditMemo());

        if ($fooCreditMemo === null) {
            return null;
        }

        return $this->mapCreditMemoEntityToCreditMemoTransfer($fooCreditMemo);
    }

    /**
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     *
     * @return \Generated\Shared\Transfer\ItemStateTransfer|null
     */
    public function findSalesOrderItemStateByIdSalesOrderItem(ItemTransfer $itemTransfer): ?ItemStateTransfer
    {
        $query = $this->getFactory()
            ->getSalesOrderItemQuery()
            ->leftJoinWithState()
            ->filterByIdSalesOrderItem($itemTransfer->getFkSalesOrderItem());

        /** @var \Generated\Shared\Transfer\SpySalesOrderItemEntityTransfer|null $salesOrderItemEntityTransfer */
        $salesOrderItemEntityTransfer = $this->buildQueryFromCriteria($query)->findOne();

        if ($salesOrderItemEntityTransfer === null) {
            return null;
        }

        return $this->mapSpySalesOrderItemEntityTransferToItemStateTransfer($salesOrderItemEntityTransfer);
    }

    /**
     * @param array<\Orm\Zed\CreditMemo\Persistence\FooCreditMemo> $entityTransferCollection
     *
     * @return \Generated\Shared\Transfer\CreditMemoCollectionTransfer
     */
    protected function mapCreditMemoEntityTransferCollectionToCreditMemoCollectionTransfer(
        array $entityTransferCollection
    ): CreditMemoCollectionTransfer {
        $creditMemoEntityCollectionTransfer = new CreditMemoCollectionTransfer();

        foreach ($entityTransferCollection as $creditMemoEntityTransfer) {
            $creditMemoTransfer = $this->mapCreditMemoEntityToCreditMemoTransfer($creditMemoEntityTransfer);

            $creditMemoEntityCollectionTransfer->addCreditMemo($creditMemoTransfer);
        }

        return $creditMemoEntityCollectionTransfer;
    }

    /**
     * @param array<\Orm\Zed\CreditMemo\Persistence\FooCreditMemoItem> $creditMemoItemEntityTransferCollection
     *
     * @return \ArrayObject<\Generated\Shared\Transfer\ItemTransfer>
     */
    protected function getCreditMemoItems(array $creditMemoItemEntityTransferCollection): ArrayObject
    {
        $items = new ArrayObject();
        foreach ($creditMemoItemEntityTransferCollection as $creditMemoItemEntityTransfer) {
            $items->append(
                $this->mapCreditMemoItemEntityTransferToItemTransfer($creditMemoItemEntityTransfer),
            );
        }

        return $items;
    }

    /**
     * @param \Orm\Zed\CreditMemo\Persistence\FooCreditMemoItem $fooCreditMemoItemEntityTransfer
     *
     * @return \Generated\Shared\Transfer\ItemTransfer
     */
    protected function mapCreditMemoItemEntityTransferToItemTransfer(
        FooCreditMemoItem $fooCreditMemoItemEntityTransfer
    ): ItemTransfer {
        $itemTransfer = new ItemTransfer();
        $itemTransfer->setName($fooCreditMemoItemEntityTransfer->getName());
        $itemTransfer->setSku($fooCreditMemoItemEntityTransfer->getSku());
        $itemTransfer->setQuantity($fooCreditMemoItemEntityTransfer->getQuantity());
        $itemTransfer->setFkCreditMemo($fooCreditMemoItemEntityTransfer->getFkCreditMemo());
        $itemTransfer->setIdCreditMemoItem($fooCreditMemoItemEntityTransfer->getIdCreditMemoItem());
        $itemTransfer->setFkSalesOrderItem($fooCreditMemoItemEntityTransfer->getFkSalesOrderItem());

        return $itemTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\SpySalesOrderItemEntityTransfer $spySalesOrderItemEntityTransfer
     *
     * @return \Generated\Shared\Transfer\ItemStateTransfer
     */
    protected function mapSpySalesOrderItemEntityTransferToItemStateTransfer(
        SpySalesOrderItemEntityTransfer $spySalesOrderItemEntityTransfer
    ): ItemStateTransfer {
        $itemStateTransfer = new ItemStateTransfer();
        $itemStateTransfer->setName($spySalesOrderItemEntityTransfer->getState()->getName());
        $itemStateTransfer->setIdSalesOrder($spySalesOrderItemEntityTransfer->getFkSalesOrder());

        return $itemStateTransfer;
    }

    /**
     * @param \Orm\Zed\CreditMemo\Persistence\FooCreditMemo $creditMemoEntityTransfer
     *
     * @return \Generated\Shared\Transfer\LocaleTransfer
     */
    protected function mapCreditMemoEntityTransferToLocaleTransfer(
        FooCreditMemo $creditMemoEntityTransfer
    ): LocaleTransfer {
        $localeTransfer = new LocaleTransfer();

        $spyLocale = $creditMemoEntityTransfer->getSpyLocale();

        if ($spyLocale !== null) {
            $localeTransfer->fromArray($spyLocale->toArray(), true);
        }

        return $localeTransfer;
    }

    /**
     * @param array<\Orm\Zed\CreditMemo\Persistence\FooCreditMemoItem> $creditMemoItems
     *
     * @return \ArrayObject<\Generated\Shared\Transfer\ItemTransfer>
     */
    protected function mapCreditMemoItemsToItemTransferCollection(
        array $creditMemoItems
    ): ArrayObject {
        $collection = new ArrayObject();

        foreach ($creditMemoItems as $creditMemoItem) {
            $itemTransfer = new ItemTransfer();
            $itemTransfer->fromArray($creditMemoItem->toArray(), true);
            $collection->append($itemTransfer);
        }

        return $collection;
    }

    /**
     * @param \Orm\Zed\CreditMemo\Persistence\FooCreditMemo $creditMemoEntityTransfer
     *
     * @return \Generated\Shared\Transfer\CreditMemoTransfer
     */
    protected function mapCreditMemoEntityToCreditMemoTransfer(FooCreditMemo $creditMemoEntityTransfer): CreditMemoTransfer
    {
        $creditMemoTransfer = (new CreditMemoTransfer())
            ->fromArray($creditMemoEntityTransfer->toArray(), true);

        $creditMemoTransfer->setLocale($this->mapCreditMemoEntityTransferToLocaleTransfer($creditMemoEntityTransfer));
        $creditMemoTransfer->setItems(
            $this->getCreditMemoItems($creditMemoEntityTransfer->getFooCreditMemoItems()->getData()),
        );

        return $creditMemoTransfer;
    }
}
