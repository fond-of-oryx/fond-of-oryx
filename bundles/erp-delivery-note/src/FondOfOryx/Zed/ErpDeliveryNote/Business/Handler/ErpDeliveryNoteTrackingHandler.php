<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Business\Handler;

use ArrayObject;
use FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Reader\ErpDeliveryNoteTrackingReaderInterface;
use FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Writer\ErpDeliveryNoteTrackingWriterInterface;
use Generated\Shared\Transfer\ErpDeliveryNoteTrackingToItemRelationTransfer;
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

        foreach ($preparedTracking[static::NEW] as $trackingData) {
            $collection->append($this->create($trackingData));
        }

        foreach ($preparedTracking[static::UPDATE] as $trackingData) {
            $trackingData->setFkErpDeliveryNote($deliveryNoteId);
            $collection->append($this->update($trackingData));
        }

        foreach ($preparedTracking[static::DELETE] as $trackingData) {
            $this->delete($trackingData->getIdErpDeliveryNoteTracking());
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
     * @return array<string, \Generated\Shared\Transfer\ErpDeliveryNoteTrackingTransfer>
     */
    protected function getExistingErpDeliveryNoteTracking(int $idErpDeliveryNote): array
    {
        $trackingCollection = $this->erpDeliveryNoteTrackingReader->findErpDeliveryNoteTrackingByIdErpDeliveryNote($idErpDeliveryNote);
        $existingTracking = [];
        foreach ($trackingCollection->getTracking() as $tracking) {
            $trackingNumber = $tracking->getTrackingNumber();
            $trackingData = $tracking;
            if (array_key_exists($trackingNumber, $existingTracking)) {
                $trackingData = $existingTracking[$trackingNumber];
            }
            foreach ($tracking->getErpDeliveryNoteItems() as $item) {
                $relation = (new ErpDeliveryNoteTrackingToItemRelationTransfer())
                    ->setQuantity($tracking->getQuantity())
                    ->setFkErpDeliveryNoteItem($item->getIdErpDeliveryNoteItem());

                $existingTracking[$trackingNumber] = $trackingData->addItemRelation($relation);
            }
        }

        return $existingTracking;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTransfer|null $existingErpDeliveryNoteTransfer
     *
     * @return array<string, array<string, \Generated\Shared\Transfer\ErpDeliveryNoteTrackingTransfer>>
     */
    protected function prepareTracking(
        ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer,
        ?ErpDeliveryNoteTransfer $existingErpDeliveryNoteTransfer = null
    ): array {
        $existingTracking = [];
        $erpDeliveryNoteTransfer->requireIdErpDeliveryNote();

        if ($existingErpDeliveryNoteTransfer !== null) {
            $existingTracking = $this->prepareExistingTracking($existingErpDeliveryNoteTransfer);
        }

        if (count($existingTracking) === 0) {
            $existingTracking = $this->getExistingErpDeliveryNoteTracking($erpDeliveryNoteTransfer->getIdErpDeliveryNote());
        }

        $new = [];
        $update = [];

        foreach ($this->prepareExistingTracking($erpDeliveryNoteTransfer) as $trackingNumber => $itemTracking) {
            if (array_key_exists($trackingNumber, $existingTracking)) {
                $existingEntry = $existingTracking[$trackingNumber];
                $itemTracking->setIdErpDeliveryNoteTracking($existingEntry->getIdErpDeliveryNoteTracking());
                $update[] = $itemTracking;
                unset($existingTracking[$trackingNumber]);

                continue;
            }
            $new[$trackingNumber] = $itemTracking;
        }

        return [
            static::NEW => $new,
            static::UPDATE => $update,
            static::DELETE => $existingTracking,
        ];
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTransfer $existingErpDeliveryNoteTransfer
     *
     * @return array<string, \Generated\Shared\Transfer\ErpDeliveryNoteTrackingTransfer>
     */
    protected function prepareExistingTracking(ErpDeliveryNoteTransfer $existingErpDeliveryNoteTransfer): array
    {
        $existingTracking = [];
        foreach ($existingErpDeliveryNoteTransfer->getDeliveryNoteItems() as $item) {
            foreach ($item->getTrackingData() as $trackingData) {
                $trackingTransfer = $trackingData;
                $trackingNumber = $trackingData->getTrackingNumber();
                if (array_key_exists($trackingNumber, $existingTracking)) {
                    $trackingTransfer = $existingTracking[$trackingNumber];
                }
                $relation =
                    (new ErpDeliveryNoteTrackingToItemRelationTransfer())
                        ->setQuantity($trackingData->getQuantity())
                        ->setFkErpDeliveryNoteItem($item->getIdErpDeliveryNoteItem());

                $existingTracking[$trackingNumber] = $trackingTransfer
                    ->addItemRelation($relation)
                    ->setFkErpDeliveryNote($existingErpDeliveryNoteTransfer->getIdErpDeliveryNote());
            }
        }

        return $existingTracking;
    }
}
