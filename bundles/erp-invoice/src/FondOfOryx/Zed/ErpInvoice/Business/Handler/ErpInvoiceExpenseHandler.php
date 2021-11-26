<?php

namespace FondOfOryx\Zed\ErpInvoice\Business\Handler;

use ArrayObject;
use FondOfOryx\Zed\ErpInvoice\Business\Model\Reader\ErpInvoiceExpenseReaderInterface;
use FondOfOryx\Zed\ErpInvoice\Business\Model\Writer\ErpInvoiceExpenseWriterInterface;
use Generated\Shared\Transfer\ErpInvoiceExpenseCollectionTransfer;
use Generated\Shared\Transfer\ErpInvoiceExpenseTransfer;
use Generated\Shared\Transfer\ErpInvoiceTransfer;

class ErpInvoiceExpenseHandler implements ErpInvoiceExpenseHandlerInterface
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
     * @var \FondOfOryx\Zed\ErpInvoice\Business\Model\Writer\ErpInvoiceExpenseWriterInterface
     */
    protected $erpInvoiceExpenseWriter;

    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Business\Model\Reader\ErpInvoiceExpenseReaderInterface
     */
    protected $erpInvoiceExpenseReader;

    /**
     * @param \FondOfOryx\Zed\ErpInvoice\Business\Model\Writer\ErpInvoiceExpenseWriterInterface $erpInvoiceExpenseWriter
     * @param \FondOfOryx\Zed\ErpInvoice\Business\Model\Reader\ErpInvoiceExpenseReaderInterface $erpInvoiceExpenseReader
     */
    public function __construct(
        ErpInvoiceExpenseWriterInterface $erpInvoiceExpenseWriter,
        ErpInvoiceExpenseReaderInterface $erpInvoiceExpenseReader
    ) {
        $this->erpInvoiceExpenseWriter = $erpInvoiceExpenseWriter;
        $this->erpInvoiceExpenseReader = $erpInvoiceExpenseReader;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceTransfer $erpInvoiceTransfer
     * @param \Generated\Shared\Transfer\ErpInvoiceTransfer|null $existingErpInvoiceTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceTransfer
     */
    public function handle(ErpInvoiceTransfer $erpInvoiceTransfer, ?ErpInvoiceTransfer $existingErpInvoiceTransfer = null): ErpInvoiceTransfer
    {
        $preparedExpenses = $this->prepareExpenses($erpInvoiceTransfer, $existingErpInvoiceTransfer);
        $collection = new ArrayObject();
        $invoiceId = $erpInvoiceTransfer->getIdErpInvoice();

        foreach ($preparedExpenses[static::NEW] as $erpInvoiceExpenseTransfer) {
            $erpInvoiceExpenseTransfer->setFkErpInvoice($invoiceId);
            $erpInvoiceExpenseTransfer = $this->create($erpInvoiceExpenseTransfer);
            $collection->append($erpInvoiceExpenseTransfer);
        }

        foreach ($preparedExpenses[static::UPDATE] as $erpInvoiceExpenseTransfer) {
            $erpInvoiceExpenseTransfer->setFkErpInvoice($invoiceId);
            $erpInvoiceExpenseTransfer = $this->update($erpInvoiceExpenseTransfer);
            $collection->append($erpInvoiceExpenseTransfer);
        }

        foreach ($preparedExpenses[static::DELETE] as $erpInvoiceExpenseTransfer) {
            $this->delete($erpInvoiceExpenseTransfer->getIdErpInvoiceExpense());
        }

        return $erpInvoiceTransfer->setExpenses($collection);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceExpenseTransfer $erpInvoiceExpenseTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceExpenseTransfer
     */
    protected function create(ErpInvoiceExpenseTransfer $erpInvoiceExpenseTransfer): ErpInvoiceExpenseTransfer
    {
        return $this->erpInvoiceExpenseWriter->create($erpInvoiceExpenseTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceExpenseTransfer $erpInvoiceExpenseTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceExpenseTransfer
     */
    protected function update(ErpInvoiceExpenseTransfer $erpInvoiceExpenseTransfer): ErpInvoiceExpenseTransfer
    {
        $erpInvoiceExpenseTransfer->requireIdErpInvoiceExpense();

        $item = $this->erpInvoiceExpenseReader->findErpInvoiceExpenseByIdErpInvoiceExpense($erpInvoiceExpenseTransfer->getIdErpInvoiceExpense());
        $item->fromArray($erpInvoiceExpenseTransfer->toArray(), true);

        return $this->erpInvoiceExpenseWriter->update($item);
    }

    /**
     * @param int $erpInvoiceExpenseId
     *
     * @return void
     */
    protected function delete(int $erpInvoiceExpenseId): void
    {
        $this->erpInvoiceExpenseWriter->delete($erpInvoiceExpenseId);
    }

    /**
     * @param int $idErpInvoice
     *
     * @return array<\Generated\Shared\Transfer\ErpInvoiceExpenseTransfer>
     */
    protected function getExistingErpInvoiceExpenses(int $idErpInvoice): array
    {
        $itemsCollection = $this->erpInvoiceExpenseReader->findErpInvoiceExpensesByIdErpInvoice($idErpInvoice);

        return $this->prepareExistingExpenses($itemsCollection);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceTransfer $erpInvoiceTransfer
     * @param \Generated\Shared\Transfer\ErpInvoiceTransfer|null $existingErpInvoiceTransfer
     *
     * @return array
     */
    protected function prepareExpenses(ErpInvoiceTransfer $erpInvoiceTransfer, ?ErpInvoiceTransfer $existingErpInvoiceTransfer = null): array
    {
        $existingExpenses = [];
        $erpInvoiceTransfer->requireIdErpInvoice();

        if ($existingErpInvoiceTransfer !== null) {
            $existingExpenses = $this->prepareExistingExpenses((new ErpInvoiceExpenseCollectionTransfer())->setExpenses($existingErpInvoiceTransfer->getExpenses()));
        }

        if (empty($existingExpenses)) {
            $existingExpenses = $this->getExistingErpInvoiceExpenses($erpInvoiceTransfer->getIdErpInvoice());
        }

        $new = [];
        $update = [];

        foreach ($erpInvoiceTransfer->getExpenses() as $erpInvoiceExpenseTransfer) {
            $name = $erpInvoiceExpenseTransfer->getName();
            if (array_key_exists($name, $existingExpenses)) {
                $updateExpense = $existingExpenses[$name];
                $idInvoiceExpense = $updateExpense->getIdErpInvoiceExpense();
                $updateExpense->fromArray($erpInvoiceExpenseTransfer->toArray(), true);
                $updateExpense->setIdErpInvoiceExpense($idInvoiceExpense);
                $update[] = $updateExpense;
                unset($existingExpenses[$name]);

                continue;
            }

            $new[] = $erpInvoiceExpenseTransfer;
        }

        return [
            static::NEW => $new,
            static::UPDATE => $update,
            static::DELETE => $existingExpenses,
        ];
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceExpenseCollectionTransfer $itemsCollection
     *
     * @return array
     */
    protected function prepareExistingExpenses(ErpInvoiceExpenseCollectionTransfer $itemsCollection): array
    {
        $existingExpenses = [];
        foreach ($itemsCollection->getExpenses() as $itemTransfer) {
            $existingExpenses[$itemTransfer->getName()] = $itemTransfer;
        }

        return $existingExpenses;
    }
}
