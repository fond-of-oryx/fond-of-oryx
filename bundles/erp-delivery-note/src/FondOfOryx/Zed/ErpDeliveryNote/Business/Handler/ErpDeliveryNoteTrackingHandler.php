<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Business\Handler;

use ArrayObject;
use FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Reader\ErpDeliveryNoteTrackingReaderInterface;
use FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Writer\ErpDeliveryNoteTrackingWriterInterface;
use Generated\Shared\Transfer\ErpDeliveryNoteTrackingCollectionTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteTrackingTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteTransfer;

class ErpDeliveryNoteTrackingHandler implements ErpDeliveryNoteTrackingHandlerInterface
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
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Writer\ErpDeliveryNoteTrackingWriterInterface
     */
    protected $erpDeliveryNoteTrackingWriter;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Reader\ErpDeliveryNoteTrackingReaderInterface
     */
    protected $erpDeliveryNoteTrackingReader;

    /**
     * @param \FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Writer\ErpDeliveryNoteTrackingWriterInterface $erpDeliveryNoteTrackingWriter
     * @param \FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Reader\ErpDeliveryNoteTrackingReaderInterface $erpDeliveryNoteTrackingReader
     */
    public function __construct(
        ErpDeliveryNoteTrackingWriterInterface $erpDeliveryNoteTrackingWriter,
        ErpDeliveryNoteTrackingReaderInterface $erpDeliveryNoteTrackingReader
    ) {
        $this->erpDeliveryNoteTrackingWriter = $erpDeliveryNoteTrackingWriter;
        $this->erpDeliveryNoteTrackingReader = $erpDeliveryNoteTrackingReader;
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
        $preparedTracking = $this->prepareTracking($erpDeliveryNoteTransfer, $existingErpDeliveryNoteTransfer);
        $collection = new ArrayObject();
        $deliveryNoteId = $erpDeliveryNoteTransfer->getIdErpDeliveryNote();

        foreach ($preparedTracking[static::NEW] as $erpDeliveryNoteTrackingTransfer) {
            $erpDeliveryNoteTrackingTransfer->setFkErpDeliveryNote($deliveryNoteId);
            $erpDeliveryNoteTrackingTransfer = $this->create($erpDeliveryNoteTrackingTransfer);
            $collection->append($erpDeliveryNoteTrackingTransfer);
        }

        foreach ($preparedTracking[static::UPDATE] as $erpDeliveryNoteTrackingTransfer) {
            $erpDeliveryNoteTrackingTransfer->setFkErpDeliveryNote($deliveryNoteId);
            $erpDeliveryNoteTrackingTransfer = $this->update($erpDeliveryNoteTrackingTransfer);
            $collection->append($erpDeliveryNoteTrackingTransfer);
        }

        foreach ($preparedTracking[static::DELETE] as $erpDeliveryNoteTrackingTransfer) {
            $this->delete($erpDeliveryNoteTrackingTransfer->getIdErpDeliveryNoteTracking());
        }

        return $erpDeliveryNoteTransfer->setTracking($collection);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTrackingTransfer $erpDeliveryNoteTrackingTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteTrackingTransfer
     */
    protected function create(ErpDeliveryNoteTrackingTransfer $erpDeliveryNoteTrackingTransfer): ErpDeliveryNoteTrackingTransfer
    {
        return $this->erpDeliveryNoteTrackingWriter->create($erpDeliveryNoteTrackingTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTrackingTransfer $erpDeliveryNoteTrackingTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteTrackingTransfer
     */
    protected function update(ErpDeliveryNoteTrackingTransfer $erpDeliveryNoteTrackingTransfer): ErpDeliveryNoteTrackingTransfer
    {
        $erpDeliveryNoteTrackingTransfer->requireIdErpDeliveryNoteTracking();

        $item = $this->erpDeliveryNoteTrackingReader->findErpDeliveryNoteTrackingByIdErpDeliveryNoteTracking($erpDeliveryNoteTrackingTransfer->getIdErpDeliveryNoteTracking());
        $item->fromArray($erpDeliveryNoteTrackingTransfer->toArray(), true);

        return $this->erpDeliveryNoteTrackingWriter->update($item);
    }

    /**
     * @param int $erpDeliveryNoteTrackingId
     *
     * @return void
     */
    protected function delete(int $erpDeliveryNoteTrackingId): void
    {
        $this->erpDeliveryNoteTrackingWriter->delete($erpDeliveryNoteTrackingId);
    }

    /**
     * @param int $idErpDeliveryNote
     *
     * @return array<\Generated\Shared\Transfer\ErpDeliveryNoteTrackingTransfer>
     */
    protected function getExistingErpDeliveryNoteTracking(int $idErpDeliveryNote): array
    {
        $itemsCollection = $this->erpDeliveryNoteTrackingReader->findErpDeliveryNoteTrackingByIdErpDeliveryNote($idErpDeliveryNote);

        return $this->prepareExistingTracking($itemsCollection);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTransfer|null $existingErpDeliveryNoteTransfer
     *
     * @return array
     */
    protected function prepareTracking(
        ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer,
        ?ErpDeliveryNoteTransfer $existingErpDeliveryNoteTransfer = null
    ): array {
        $existingTracking = [];
        $erpDeliveryNoteTransfer->requireIdErpDeliveryNote();

        if ($existingErpDeliveryNoteTransfer !== null) {
            $existingTracking = $this->prepareExistingTracking((new ErpDeliveryNoteTrackingCollectionTransfer())->setTracking($existingErpDeliveryNoteTransfer->trac()));
        }

        if (count($existingTracking) === 0) {
            $existingTracking = $this->getExistingErpDeliveryNoteTracking($erpDeliveryNoteTransfer->getIdErpDeliveryNote());
        }

        $new = [];
        $update = [];

        foreach ($erpDeliveryNoteTransfer->getTracking() as $erpDeliveryNoteTrackingTransfer) {
            $name = $erpDeliveryNoteTrackingTransfer->getName();
            if (array_key_exists($name, $existingTracking)) {
                $updateTracking = $existingTracking[$name];
                $idDeliveryNoteTracking = $updateTracking->getIdErpDeliveryNoteTracking();
                $updateTracking->fromArray($erpDeliveryNoteTrackingTransfer->toArray(), true);
                $updateTracking->setIdErpDeliveryNoteTracking($idDeliveryNoteTracking);
                $update[] = $updateTracking;
                unset($existingTracking[$name]);

                continue;
            }

            $new[] = $erpDeliveryNoteTrackingTransfer;
        }

        return [
            static::NEW => $new,
            static::UPDATE => $update,
            static::DELETE => $existingTracking,
        ];
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTrackingCollectionTransfer $itemsCollection
     *
     * @return array
     */
    protected function prepareExistingTracking(ErpDeliveryNoteTrackingCollectionTransfer $itemsCollection): array
    {
        $existingTracking = [];
        foreach ($itemsCollection->getTracking() as $itemTransfer) {
            $existingTracking[$itemTransfer->getName()] = $itemTransfer;
        }

        return $existingTracking;
    }
}
