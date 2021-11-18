<?php

namespace FondOfOryx\Zed\ErpInvoice\Business\Handler;

use ArrayObject;
use FondOfOryx\Zed\ErpInvoice\Business\Model\Reader\ErpInvoiceItemReaderInterface;
use FondOfOryx\Zed\ErpInvoice\Business\Model\Writer\ErpInvoiceItemWriterInterface;
use Generated\Shared\Transfer\ErpInvoiceItemCollectionTransfer;
use Generated\Shared\Transfer\ErpInvoiceItemTransfer;
use Generated\Shared\Transfer\ErpInvoiceTransfer;

class ErpInvoiceItemHandler implements ErpInvoiceItemHandlerInterface
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
     * @var \FondOfOryx\Zed\ErpInvoice\Business\Model\Writer\ErpInvoiceItemWriterInterface
     */
    protected $erpInvoiceItemWriter;

    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Business\Model\Reader\ErpInvoiceItemReaderInterface
     */
    protected $erpInvoiceItemReader;

    /**
     * @param \FondOfOryx\Zed\ErpInvoice\Business\Model\Writer\ErpInvoiceItemWriterInterface $erpInvoiceItemWriter
     * @param \FondOfOryx\Zed\ErpInvoice\Business\Model\Reader\ErpInvoiceItemReaderInterface $erpInvoiceItemReader
     */
    public function __construct(
        ErpInvoiceItemWriterInterface $erpInvoiceItemWriter,
        ErpInvoiceItemReaderInterface $erpInvoiceItemReader
    ) {
        $this->erpInvoiceItemWriter = $erpInvoiceItemWriter;
        $this->erpInvoiceItemReader = $erpInvoiceItemReader;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceTransfer $erpInvoiceTransfer
     * @param \Generated\Shared\Transfer\ErpInvoiceTransfer|null $existingErpInvoiceTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceTransfer
     */
    public function handle(ErpInvoiceTransfer $erpInvoiceTransfer, ?ErpInvoiceTransfer $existingErpInvoiceTransfer = null): ErpInvoiceTransfer
    {
        $preparedItems = $this->prepareItems($erpInvoiceTransfer, $existingErpInvoiceTransfer);
        $collection = new ArrayObject();
        $invoiceId = $erpInvoiceTransfer->getIdErpInvoice();

        foreach ($preparedItems[static::NEW] as $erpInvoiceItemTransfer) {
            $erpInvoiceItemTransfer->setFkErpInvoice($invoiceId);
            $erpInvoiceItemTransfer = $this->create($erpInvoiceItemTransfer);
            $collection->append($erpInvoiceItemTransfer);
        }

        foreach ($preparedItems[static::UPDATE] as $erpInvoiceItemTransfer) {
            $erpInvoiceItemTransfer->setFkErpInvoice($invoiceId);
            $erpInvoiceItemTransfer = $this->update($erpInvoiceItemTransfer);
            $collection->append($erpInvoiceItemTransfer);
        }

        foreach ($preparedItems[static::DELETE] as $erpInvoiceItemTransfer) {
            $this->delete($erpInvoiceItemTransfer->getIdErpInvoiceItem());
        }

        return $erpInvoiceTransfer->setInvoiceItems($collection);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceItemTransfer $erpInvoiceItemTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceItemTransfer
     */
    protected function create(ErpInvoiceItemTransfer $erpInvoiceItemTransfer): ErpInvoiceItemTransfer
    {
        return $this->erpInvoiceItemWriter->create($erpInvoiceItemTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceItemTransfer $erpInvoiceItemTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceItemTransfer
     */
    protected function update(ErpInvoiceItemTransfer $erpInvoiceItemTransfer): ErpInvoiceItemTransfer
    {
        $erpInvoiceItemTransfer->requireIdErpInvoiceItem();

        $item = $this->erpInvoiceItemReader->findErpInvoiceItemByIdErpInvoiceItem($erpInvoiceItemTransfer->getIdErpInvoiceItem());
        $item->fromArray($erpInvoiceItemTransfer->toArray(), true);

        return $this->erpInvoiceItemWriter->update($item);
    }

    /**
     * @param int $erpInvoiceItemId
     *
     * @return void
     */
    protected function delete(int $erpInvoiceItemId): void
    {
        $this->erpInvoiceItemWriter->delete($erpInvoiceItemId);
    }

    /**
     * @param int $idErpInvoice
     *
     * @return array<\Generated\Shared\Transfer\ErpInvoiceItemTransfer>
     */
    protected function getExistingErpInvoiceItems(int $idErpInvoice): array
    {
        $itemsCollection = $this->erpInvoiceItemReader->findErpInvoiceItemsByIdErpInvoice($idErpInvoice);

        return $this->prepareExistingItems($itemsCollection);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceTransfer $erpInvoiceTransfer
     * @param \Generated\Shared\Transfer\ErpInvoiceTransfer|null $existingErpInvoiceTransfer
     *
     * @return array
     */
    protected function prepareItems(ErpInvoiceTransfer $erpInvoiceTransfer, ?ErpInvoiceTransfer $existingErpInvoiceTransfer = null): array
    {
        $existingItems = [];
        $erpInvoiceTransfer->requireIdErpInvoice();

        if ($existingErpInvoiceTransfer !== null) {
            $existingItems = $this->prepareExistingItems((new ErpInvoiceItemCollectionTransfer())->setItems($existingErpInvoiceTransfer->getInvoiceItems()));
        }

        if (empty($existingItems)) {
            $existingItems = $this->getExistingErpInvoiceItems($erpInvoiceTransfer->getIdErpInvoice());
        }

        $new = [];
        $update = [];

        foreach ($erpInvoiceTransfer->getInvoiceItems() as $erpInvoiceItemTransfer) {
            $sku = $erpInvoiceItemTransfer->getSku();
            if (array_key_exists($sku, $existingItems)) {
                $updateItem = $existingItems[$sku];
                $idInvoiceItem = $updateItem->getIdErpInvoiceItem();
                $updateItem->fromArray($erpInvoiceItemTransfer->toArray(), true);
                $updateItem->setIdErpInvoiceItem($idInvoiceItem);
                $update[] = $updateItem;
                unset($existingItems[$sku]);

                continue;
            }

            $new[] = $erpInvoiceItemTransfer;
        }

        return [
            static::NEW => $new,
            static::UPDATE => $update,
            static::DELETE => $existingItems,
        ];
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceItemCollectionTransfer $itemsCollection
     *
     * @return array
     */
    protected function prepareExistingItems(ErpInvoiceItemCollectionTransfer $itemsCollection): array
    {
        $existingItems = [];
        foreach ($itemsCollection->getItems() as $itemTransfer) {
            $existingItems[$itemTransfer->getSku()] = $itemTransfer;
        }

        return $existingItems;
    }
}
