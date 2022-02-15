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
     * @return array
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
            $sku = $erpDeliveryNoteItemTransfer->getSku();
            if (array_key_exists($sku, $existingItems)) {
                $updateItem = $existingItems[$sku];
                $idDeliveryNoteItem = $updateItem->getIdErpDeliveryNoteItem();
                $updateItem->fromArray($erpDeliveryNoteItemTransfer->toArray(), true);
                $updateItem->setIdErpDeliveryNoteItem($idDeliveryNoteItem);
                $update[] = $updateItem;
                unset($existingItems[$sku]);

                continue;
            }

            $new[] = $erpDeliveryNoteItemTransfer;
        }

        return [
            static::NEW => $new,
            static::UPDATE => $update,
            static::DELETE => $existingItems,
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
            $existingItems[$itemTransfer->getSku()] = $itemTransfer;
        }

        return $existingItems;
    }
}
