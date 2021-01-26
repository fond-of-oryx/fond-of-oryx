<?php

namespace FondOfOryx\Zed\ErpOrder\Business\Handler;

use ArrayObject;
use FondOfOryx\Zed\ErpOrder\Business\Model\Reader\ErpOrderItemReaderInterface;
use FondOfOryx\Zed\ErpOrder\Business\Model\Writer\ErpOrderItemWriterInterface;
use Generated\Shared\Transfer\ErpOrderItemTransfer;
use Generated\Shared\Transfer\ErpOrderTransfer;

class ErpOrderItemHandler implements ErpOrderItemHandlerInterface
{
    protected const NEW = 'new';
    protected const UPDATE = 'update';
    protected const DELETE = 'delete';

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Business\Model\Writer\ErpOrderItemWriterInterface
     */
    protected $erpOrderItemWriter;

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Business\Model\Reader\ErpOrderItemReaderInterface
     */
    protected $erpOrderItemReader;

    /**
     * @param \FondOfOryx\Zed\ErpOrder\Business\Model\Writer\ErpOrderItemWriterInterface $erpOrderItemWriter
     * @param \FondOfOryx\Zed\ErpOrder\Business\Model\Reader\ErpOrderItemReaderInterface $erpOrderItemReader
     */
    public function __construct(
        ErpOrderItemWriterInterface $erpOrderItemWriter,
        ErpOrderItemReaderInterface $erpOrderItemReader
    ) {
        $this->erpOrderItemWriter = $erpOrderItemWriter;
        $this->erpOrderItemReader = $erpOrderItemReader;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderTransfer $erpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderTransfer
     */
    public function handle(ErpOrderTransfer $erpOrderTransfer): ErpOrderTransfer
    {
        $preparedItems = $this->prepareItems($erpOrderTransfer);
        $collection = new ArrayObject();
        $orderId = $erpOrderTransfer->getIdErpOrder();

        foreach ($preparedItems[static::NEW] as $erpOrderItemTransfer) {
            $erpOrderItemTransfer->setFkErpOrder($orderId);
            $erpOrderItemTransfer = $this->create($erpOrderItemTransfer);
            $collection->append($erpOrderItemTransfer);
        }

        foreach ($preparedItems[static::UPDATE] as $erpOrderItemTransfer) {
            $erpOrderItemTransfer->setFkErpOrder($orderId);
            $erpOrderItemTransfer = $this->update($erpOrderItemTransfer);
            $collection->append($erpOrderItemTransfer);
        }

        foreach ($preparedItems[static::DELETE] as $erpOrderItemTransfer) {
            $this->delete($erpOrderItemTransfer->getIdErpOrderItem());
        }

        return $erpOrderTransfer->setOrderItems($collection);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderItemTransfer $erpOrderItemTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderItemTransfer
     */
    protected function create(ErpOrderItemTransfer $erpOrderItemTransfer): ErpOrderItemTransfer
    {
        return $this->erpOrderItemWriter->create($erpOrderItemTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderItemTransfer $erpOrderItemTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderItemTransfer
     */
    protected function update(ErpOrderItemTransfer $erpOrderItemTransfer): ErpOrderItemTransfer
    {
        $erpOrderItemTransfer->requireIdErpOrderItem();

        $item = $this->erpOrderItemReader->findErpOrderItemByIdErpOrderItem($erpOrderItemTransfer->getIdErpOrderItem());
        $item->fromArray($erpOrderItemTransfer->toArray(), true);

        return $this->erpOrderItemWriter->update($item);
    }

    /**
     * @param int $erpOrderItemId
     *
     * @return void
     */
    protected function delete(int $erpOrderItemId): void
    {
        $this->erpOrderItemWriter->delete($erpOrderItemId);
    }

    /**
     * @param int $idErpOrder
     *
     * @return \Generated\Shared\Transfer\ErpOrderItemTransfer[]
     */
    protected function getExistingErpOrderItems(int $idErpOrder): array
    {
        $itemsCollection = $this->erpOrderItemReader->findErpOrderItemsByIdErpOrder($idErpOrder);
        $existingItems = [];
        foreach ($itemsCollection->getItems() as $itemTransfer) {
            $existingItems[$itemTransfer->getSku()] = $itemTransfer;
        }

        return $existingItems;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderTransfer $erpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderItemTransfer[][]
     */
    protected function prepareItems(ErpOrderTransfer $erpOrderTransfer): array
    {
        $erpOrderTransfer->requireIdErpOrder();

        $existingItems = $this->getExistingErpOrderItems($erpOrderTransfer->getIdErpOrder());
        $new = [];
        $update = [];

        foreach ($erpOrderTransfer->getOrderItems() as $erpOrderItemTransfer) {
            $sku = $erpOrderItemTransfer->getSku();
            if (array_key_exists($sku, $existingItems)) {
                $updateItem = $existingItems[$sku];
                $idOrderItem = $updateItem->getIdErpOrderItem();
                $updateItem->fromArray($erpOrderItemTransfer->toArray(), true);
                $updateItem->setIdErpOrderItem($idOrderItem);
                $update[] = $updateItem;
                unset($existingItems[$sku]);

                continue;
            }

            $new[] = $erpOrderItemTransfer;
        }

        return [
            static::NEW => $new,
            static::UPDATE => $update,
            static::DELETE => $existingItems,
        ];
    }
}
