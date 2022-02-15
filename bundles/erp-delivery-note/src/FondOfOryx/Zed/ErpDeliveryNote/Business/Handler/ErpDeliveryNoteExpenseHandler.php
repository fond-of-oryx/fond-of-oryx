<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Business\Handler;

use ArrayObject;
use FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Reader\ErpDeliveryNoteExpenseReaderInterface;
use FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Writer\ErpDeliveryNoteExpenseWriterInterface;
use Generated\Shared\Transfer\ErpDeliveryNoteExpenseCollectionTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteExpenseTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteTransfer;

class ErpDeliveryNoteExpenseHandler implements ErpDeliveryNoteExpenseHandlerInterface
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
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Writer\ErpDeliveryNoteExpenseWriterInterface
     */
    protected $erpDeliveryNoteExpenseWriter;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Reader\ErpDeliveryNoteExpenseReaderInterface
     */
    protected $erpDeliveryNoteExpenseReader;

    /**
     * @param \FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Writer\ErpDeliveryNoteExpenseWriterInterface $erpDeliveryNoteExpenseWriter
     * @param \FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Reader\ErpDeliveryNoteExpenseReaderInterface $erpDeliveryNoteExpenseReader
     */
    public function __construct(
        ErpDeliveryNoteExpenseWriterInterface $erpDeliveryNoteExpenseWriter,
        ErpDeliveryNoteExpenseReaderInterface $erpDeliveryNoteExpenseReader
    ) {
        $this->erpDeliveryNoteExpenseWriter = $erpDeliveryNoteExpenseWriter;
        $this->erpDeliveryNoteExpenseReader = $erpDeliveryNoteExpenseReader;
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
        $preparedExpenses = $this->prepareExpenses($erpDeliveryNoteTransfer, $existingErpDeliveryNoteTransfer);
        $collection = new ArrayObject();
        $deliveryNoteId = $erpDeliveryNoteTransfer->getIdErpDeliveryNote();

        foreach ($preparedExpenses[static::NEW] as $erpDeliveryNoteExpenseTransfer) {
            $erpDeliveryNoteExpenseTransfer->setFkErpDeliveryNote($deliveryNoteId);
            $erpDeliveryNoteExpenseTransfer = $this->create($erpDeliveryNoteExpenseTransfer);
            $collection->append($erpDeliveryNoteExpenseTransfer);
        }

        foreach ($preparedExpenses[static::UPDATE] as $erpDeliveryNoteExpenseTransfer) {
            $erpDeliveryNoteExpenseTransfer->setFkErpDeliveryNote($deliveryNoteId);
            $erpDeliveryNoteExpenseTransfer = $this->update($erpDeliveryNoteExpenseTransfer);
            $collection->append($erpDeliveryNoteExpenseTransfer);
        }

        foreach ($preparedExpenses[static::DELETE] as $erpDeliveryNoteExpenseTransfer) {
            $this->delete($erpDeliveryNoteExpenseTransfer->getIdErpDeliveryNoteExpense());
        }

        return $erpDeliveryNoteTransfer->setExpenses($collection);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteExpenseTransfer $erpDeliveryNoteExpenseTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteExpenseTransfer
     */
    protected function create(ErpDeliveryNoteExpenseTransfer $erpDeliveryNoteExpenseTransfer): ErpDeliveryNoteExpenseTransfer
    {
        return $this->erpDeliveryNoteExpenseWriter->create($erpDeliveryNoteExpenseTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteExpenseTransfer $erpDeliveryNoteExpenseTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteExpenseTransfer
     */
    protected function update(ErpDeliveryNoteExpenseTransfer $erpDeliveryNoteExpenseTransfer): ErpDeliveryNoteExpenseTransfer
    {
        $erpDeliveryNoteExpenseTransfer->requireIdErpDeliveryNoteExpense();

        $item = $this->erpDeliveryNoteExpenseReader->findErpDeliveryNoteExpenseByIdErpDeliveryNoteExpense($erpDeliveryNoteExpenseTransfer->getIdErpDeliveryNoteExpense());
        $item->fromArray($erpDeliveryNoteExpenseTransfer->toArray(), true);

        return $this->erpDeliveryNoteExpenseWriter->update($item);
    }

    /**
     * @param int $erpDeliveryNoteExpenseId
     *
     * @return void
     */
    protected function delete(int $erpDeliveryNoteExpenseId): void
    {
        $this->erpDeliveryNoteExpenseWriter->delete($erpDeliveryNoteExpenseId);
    }

    /**
     * @param int $idErpDeliveryNote
     *
     * @return array<\Generated\Shared\Transfer\ErpDeliveryNoteExpenseTransfer>
     */
    protected function getExistingErpDeliveryNoteExpenses(int $idErpDeliveryNote): array
    {
        $itemsCollection = $this->erpDeliveryNoteExpenseReader->findErpDeliveryNoteExpensesByIdErpDeliveryNote($idErpDeliveryNote);

        return $this->prepareExistingExpenses($itemsCollection);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTransfer|null $existingErpDeliveryNoteTransfer
     *
     * @return array
     */
    protected function prepareExpenses(
        ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer,
        ?ErpDeliveryNoteTransfer $existingErpDeliveryNoteTransfer = null
    ): array {
        $existingExpenses = [];
        $erpDeliveryNoteTransfer->requireIdErpDeliveryNote();

        if ($existingErpDeliveryNoteTransfer !== null) {
            $existingExpenses = $this->prepareExistingExpenses((new ErpDeliveryNoteExpenseCollectionTransfer())->setExpenses($existingErpDeliveryNoteTransfer->getExpenses()));
        }

        if (count($existingExpenses) === 0) {
            $existingExpenses = $this->getExistingErpDeliveryNoteExpenses($erpDeliveryNoteTransfer->getIdErpDeliveryNote());
        }

        $new = [];
        $update = [];

        foreach ($erpDeliveryNoteTransfer->getExpenses() as $erpDeliveryNoteExpenseTransfer) {
            $name = $erpDeliveryNoteExpenseTransfer->getName();
            if (array_key_exists($name, $existingExpenses)) {
                $updateExpense = $existingExpenses[$name];
                $idDeliveryNoteExpense = $updateExpense->getIdErpDeliveryNoteExpense();
                $updateExpense->fromArray($erpDeliveryNoteExpenseTransfer->toArray(), true);
                $updateExpense->setIdErpDeliveryNoteExpense($idDeliveryNoteExpense);
                $update[] = $updateExpense;
                unset($existingExpenses[$name]);

                continue;
            }

            $new[] = $erpDeliveryNoteExpenseTransfer;
        }

        return [
            static::NEW => $new,
            static::UPDATE => $update,
            static::DELETE => $existingExpenses,
        ];
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteExpenseCollectionTransfer $itemsCollection
     *
     * @return array
     */
    protected function prepareExistingExpenses(ErpDeliveryNoteExpenseCollectionTransfer $itemsCollection): array
    {
        $existingExpenses = [];
        foreach ($itemsCollection->getExpenses() as $itemTransfer) {
            $existingExpenses[$itemTransfer->getName()] = $itemTransfer;
        }

        return $existingExpenses;
    }
}
