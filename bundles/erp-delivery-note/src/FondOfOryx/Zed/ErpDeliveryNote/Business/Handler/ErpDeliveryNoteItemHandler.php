<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Business\Handler;

use ArrayObject;
use FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Reader\ErpDeliveryNoteItemReaderInterface;
use FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Writer\ErpDeliveryNoteItemWriterInterface;
use Generated\Shared\Transfer\ErpDeliveryNoteItemCollectionTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteTransfer;

class ErpDeliveryNoteItemHandler implements ErpDeliveryNoteItemHandlerInterface
{
    /**
     * @var string
     */
    protected const NEW = 'new';

    /**
     * @var string
     */
    protected const UPDATE = 'update';

    /**
     * @var string
     */
    protected const DELETE = 'delete';

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Writer\ErpDeliveryNoteItemWriterInterface
     */
    protected $erpDeliveryNoteItemWriter;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Reader\ErpDeliveryNoteItemReaderInterface
     */
    protected $erpDeliveryNoteItemReader;

    /**
     * @param \FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Writer\ErpDeliveryNoteItemWriterInterface $erpDeliveryNoteItemWriter
     * @param \FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Reader\ErpDeliveryNoteItemReaderInterface $erpDeliveryNoteItemReader
     */
    public function __construct(
        ErpDeliveryNoteItemWriterInterface $erpDeliveryNoteItemWriter,
        ErpDeliveryNoteItemReaderInterface $erpDeliveryNoteItemReader
    ) {
        $this->erpDeliveryNoteItemWriter = $erpDeliveryNoteItemWriter;
        $this->erpDeliveryNoteItemReader = $erpDeliveryNoteItemReader;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTransfer|null $existingErpDeliveryNoteTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteTransfer
     */
    public function handle(
        ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer,
        ?ErpDeliveryNoteTransfer $existingErpDeliveryNoteTransfer = null
    ): ErpDeliveryNoteTransfer {
        $preparedItems = $this->prepareItems($erpDeliveryNoteTransfer, $existingErpDeliveryNoteTransfer);
        $collection = new ArrayObject();
        $deliveryNoteId = $erpDeliveryNoteTransfer->getIdErpDeliveryNote();

        foreach ($preparedItems[static::NEW] as $erpDeliveryNoteItemTransfer) {
            $erpDeliveryNoteItemTransfer->setFkErpDeliveryNote($deliveryNoteId);
            $erpDeliveryNoteItemTransfer = $this->create($erpDeliveryNoteItemTransfer);
            $collection->append($erpDeliveryNoteItemTransfer);
        }

        foreach ($preparedItems[static::UPDATE] as $erpDeliveryNoteItemTransfer) {
            $erpDeliveryNoteItemTransfer->setFkErpDeliveryNote($deliveryNoteId);
            $erpDeliveryNoteItemTransfer = $this->update($erpDeliveryNoteItemTransfer);
            $collection->append($erpDeliveryNoteItemTransfer);
        }

        foreach ($preparedItems[static::DELETE] as $erpDeliveryNoteItemTransfer) {
            $this->delete($erpDeliveryNoteItemTransfer->getIdErpDeliveryNoteItem());
        }

        return $erpDeliveryNoteTransfer->setDeliveryNoteItems($collection);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer $erpDeliveryNoteItemTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer
     */
    protected function create(ErpDeliveryNoteItemTransfer $erpDeliveryNoteItemTransfer): ErpDeliveryNoteItemTransfer
    {
        return $this->erpDeliveryNoteItemWriter->create($erpDeliveryNoteItemTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer $erpDeliveryNoteItemTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer
     */
    protected function update(ErpDeliveryNoteItemTransfer $erpDeliveryNoteItemTransfer): ErpDeliveryNoteItemTransfer
    {
        $erpDeliveryNoteItemTransfer->requireIdErpDeliveryNoteItem();

        $item = $this->erpDeliveryNoteItemReader->findErpDeliveryNoteItemByIdErpDeliveryNoteItem($erpDeliveryNoteItemTransfer->getIdErpDeliveryNoteItem());
        $item->fromArray($erpDeliveryNoteItemTransfer->toArray(), true);

        return $this->erpDeliveryNoteItemWriter->update($item);
    }

    /**
     * @param int $erpDeliveryNoteItemId
     *
     * @return void
     */
    protected function delete(int $erpDeliveryNoteItemId): void
    {
        $this->erpDeliveryNoteItemWriter->delete($erpDeliveryNoteItemId);
    }

    /**
     * @param int $idErpDeliveryNote
     *
     * @return array<\Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer>
     */
    protected function getExistingErpDeliveryNoteItems(int $idErpDeliveryNote): array
    {
        $itemsCollection = $this->erpDeliveryNoteItemReader->findErpDeliveryNoteItemsByIdErpDeliveryNote($idErpDeliveryNote);

        return $this->prepareExistingItems($itemsCollection);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTransfer|null $existingErpDeliveryNoteTransfer
     *
     * @return array<string, array<\Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer>>
     */
    protected function prepareItems(ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer, ?ErpDeliveryNoteTransfer $existingErpDeliveryNoteTransfer = null): array
    {
        $existingItems = [];
        $erpDeliveryNoteTransfer->requireIdErpDeliveryNote();

        if ($existingErpDeliveryNoteTransfer !== null) {
            $existingItems = $this->prepareExistingItems((new ErpDeliveryNoteItemCollectionTransfer())->setItems($existingErpDeliveryNoteTransfer->getDeliveryNoteItems()));
        }

        if (count($existingItems) === 0) {
            $existingItems = $this->getExistingErpDeliveryNoteItems($erpDeliveryNoteTransfer->getIdErpDeliveryNote());
        }

        $new = [];
        $update = [];

        foreach ($erpDeliveryNoteTransfer->getDeliveryNoteItems() as $erpDeliveryNoteItemTransfer) {
            $itemIndex = $this->getItemIndex($erpDeliveryNoteItemTransfer);
            if (array_key_exists($itemIndex, $existingItems)) {
                $update[] = $this->updateItemData(array_pop($existingItems[$itemIndex]), $erpDeliveryNoteItemTransfer);
                if (count($existingItems[$itemIndex]) === 0) {
                    unset($existingItems[$itemIndex]);
                }

                continue;
            }

            $new[] = $erpDeliveryNoteItemTransfer;
        }

        $delete = $this->resolveItemsToDelete($existingItems);

        return [
            static::NEW => $new,
            static::UPDATE => $update,
            static::DELETE => $delete,
        ];
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteItemCollectionTransfer $itemsCollection
     *
     * @return array
     */
    protected function prepareExistingItems(ErpDeliveryNoteItemCollectionTransfer $itemsCollection): array
    {
        $existingItems = [];
        foreach ($itemsCollection->getItems() as $itemTransfer) {
            $existingItems[$this->getItemIndex($itemTransfer)][] = $itemTransfer;
        }

        return $existingItems;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer $itemTransfer
     *
     * @return string
     */
    protected function getItemIndex(ErpDeliveryNoteItemTransfer $itemTransfer): string
    {
        return sprintf('%s.%s', $itemTransfer->getSku(), $itemTransfer->getPosition());
    }

/**
 * @param array<array<\Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer>> $existingItems
 *
 * @return array<\Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer>
 */
    protected function resolveItemsToDelete(array $existingItems): array
    {
        $delete = [];
        foreach ($existingItems as $existingItemBag) {
            foreach ($existingItemBag as $existingItem) {
                $delete[] = $existingItem;
            }
        }

        return $delete;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer $updateItem
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer $erpDeliveryNoteItemTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer
     */
    protected function updateItemData(
        ErpDeliveryNoteItemTransfer $updateItem,
        ErpDeliveryNoteItemTransfer $erpDeliveryNoteItemTransfer
    ): ErpDeliveryNoteItemTransfer {
        $idDeliveryNoteItem = $updateItem->getIdErpDeliveryNoteItem();
        $updateItem->fromArray($erpDeliveryNoteItemTransfer->modifiedToArray(), true);
        $updateItem->setIdErpDeliveryNoteItem($idDeliveryNoteItem);

        return $updateItem;
    }
}
