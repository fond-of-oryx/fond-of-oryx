<?php

namespace FondOfOryx\Zed\ErpOrder\Business\Handler;

use ArrayObject;
use FondOfOryx\Zed\ErpOrder\Business\Model\Reader\ErpOrderExpenseReaderInterface;
use FondOfOryx\Zed\ErpOrder\Business\Model\Writer\ErpOrderExpenseWriterInterface;
use Generated\Shared\Transfer\ErpOrderExpenseCollectionTransfer;
use Generated\Shared\Transfer\ErpOrderExpenseTransfer;
use Generated\Shared\Transfer\ErpOrderTransfer;

class ErpOrderExpenseHandler implements ErpOrderExpenseHandlerInterface
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
     * @var \FondOfOryx\Zed\ErpOrder\Business\Model\Writer\ErpOrderExpenseWriterInterface
     */
    protected $erpOrderExpenseWriter;

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Business\Model\Reader\ErpOrderExpenseReaderInterface
     */
    protected $erpOrderExpenseReader;

    /**
     * @param \FondOfOryx\Zed\ErpOrder\Business\Model\Writer\ErpOrderExpenseWriterInterface $erpOrderExpenseWriter
     * @param \FondOfOryx\Zed\ErpOrder\Business\Model\Reader\ErpOrderExpenseReaderInterface $erpOrderExpenseReader
     */
    public function __construct(
        ErpOrderExpenseWriterInterface $erpOrderExpenseWriter,
        ErpOrderExpenseReaderInterface $erpOrderExpenseReader
    ) {
        $this->erpOrderExpenseWriter = $erpOrderExpenseWriter;
        $this->erpOrderExpenseReader = $erpOrderExpenseReader;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderTransfer $erpOrderTransfer
     * @param \Generated\Shared\Transfer\ErpOrderTransfer|null $existingErpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderTransfer
     */
    public function handle(ErpOrderTransfer $erpOrderTransfer, ?ErpOrderTransfer $existingErpOrderTransfer = null): ErpOrderTransfer
    {
        $preparedExpenses = $this->prepareExpenses($erpOrderTransfer, $existingErpOrderTransfer);
        $collection = new ArrayObject();
        $orderId = $erpOrderTransfer->getIdErpOrder();

        foreach ($preparedExpenses[static::NEW] as $erpOrderExpenseTransfer) {
            $erpOrderExpenseTransfer->setFkErpOrder($orderId);
            $erpOrderExpenseTransfer = $this->create($erpOrderExpenseTransfer);
            $collection->append($erpOrderExpenseTransfer);
        }

        foreach ($preparedExpenses[static::UPDATE] as $erpOrderExpenseTransfer) {
            $erpOrderExpenseTransfer->setFkErpOrder($orderId);
            $erpOrderExpenseTransfer = $this->update($erpOrderExpenseTransfer);
            $collection->append($erpOrderExpenseTransfer);
        }

        foreach ($preparedExpenses[static::DELETE] as $erpOrderExpenseTransfer) {
            $this->delete($erpOrderExpenseTransfer->getIdErpOrderExpense());
        }

        return $erpOrderTransfer->setOrderExpenses($collection);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderExpenseTransfer $erpOrderExpenseTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderExpenseTransfer
     */
    protected function create(ErpOrderExpenseTransfer $erpOrderExpenseTransfer): ErpOrderExpenseTransfer
    {
        return $this->erpOrderExpenseWriter->create($erpOrderExpenseTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderExpenseTransfer $erpOrderExpenseTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderExpenseTransfer
     */
    protected function update(ErpOrderExpenseTransfer $erpOrderExpenseTransfer): ErpOrderExpenseTransfer
    {
        $erpOrderExpenseTransfer->requireIdErpOrderExpense();

        $item = $this->erpOrderExpenseReader->findErpOrderExpenseByIdErpOrderExpense($erpOrderExpenseTransfer->getIdErpOrderExpense());
        $item->fromArray($erpOrderExpenseTransfer->toArray(), true);

        return $this->erpOrderExpenseWriter->update($item);
    }

    /**
     * @param int $erpOrderExpenseId
     *
     * @return void
     */
    protected function delete(int $erpOrderExpenseId): void
    {
        $this->erpOrderExpenseWriter->delete($erpOrderExpenseId);
    }

    /**
     * @param int $idErpOrder
     *
     * @return array<\Generated\Shared\Transfer\ErpOrderExpenseTransfer>
     */
    protected function getExistingErpOrderExpenses(int $idErpOrder): array
    {
        $itemsCollection = $this->erpOrderExpenseReader->findErpOrderExpensesByIdErpOrder($idErpOrder);

        return $this->prepareExistingExpenses($itemsCollection);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderTransfer $erpOrderTransfer
     * @param \Generated\Shared\Transfer\ErpOrderTransfer|null $existingErpOrderTransfer
     *
     * @return array
     */
    protected function prepareExpenses(ErpOrderTransfer $erpOrderTransfer, ?ErpOrderTransfer $existingErpOrderTransfer = null): array
    {
        $existingExpenses = [];
        $erpOrderTransfer->requireIdErpOrder();

        if ($existingErpOrderTransfer !== null) {
            $existingExpenses = $this->prepareExistingExpenses((new ErpOrderExpenseCollectionTransfer())->setExpenses($existingErpOrderTransfer->getOrderExpenses()));
        }

        if (count($existingExpenses) === 0) {
            $existingExpenses = $this->getExistingErpOrderExpenses($erpOrderTransfer->getIdErpOrder());
        }

        $new = [];
        $update = [];

        foreach ($erpOrderTransfer->getOrderExpenses() as $erpOrderExpenseTransfer) {
            $name = $erpOrderExpenseTransfer->getName();
            if (array_key_exists($name, $existingExpenses)) {
                $updateExpense = $existingExpenses[$name];
                $idOrderExpense = $updateExpense->getIdErpOrderExpense();
                $updateExpense->fromArray($erpOrderExpenseTransfer->toArray(), true);
                $updateExpense->setIdErpOrderExpense($idOrderExpense);
                $update[] = $updateExpense;
                unset($existingExpenses[$name]);

                continue;
            }

            $new[] = $erpOrderExpenseTransfer;
        }

        return [
            static::NEW => $new,
            static::UPDATE => $update,
            static::DELETE => $existingExpenses,
        ];
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderExpenseCollectionTransfer $itemsCollection
     *
     * @return array
     */
    protected function prepareExistingExpenses(ErpOrderExpenseCollectionTransfer $itemsCollection): array
    {
        $existingExpenses = [];
        foreach ($itemsCollection->getExpenses() as $itemTransfer) {
            $existingExpenses[$itemTransfer->getName()] = $itemTransfer;
        }

        return $existingExpenses;
    }
}
