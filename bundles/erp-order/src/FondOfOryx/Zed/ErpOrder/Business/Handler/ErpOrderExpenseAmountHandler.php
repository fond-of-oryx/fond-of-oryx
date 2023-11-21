<?php

namespace FondOfOryx\Zed\ErpOrder\Business\Handler;

use FondOfOryx\Zed\ErpOrder\Business\Model\Reader\ReaderInterface;
use FondOfOryx\Zed\ErpOrder\Business\Model\Writer\ErpOrderAmountWriterInterface;
use Generated\Shared\Transfer\ErpOrderAmountTransfer;
use Generated\Shared\Transfer\ErpOrderExpenseTransfer;
use Generated\Shared\Transfer\ErpOrderTransfer;

class ErpOrderExpenseAmountHandler implements ErpOrderExpenseAmountHandlerInterface
{
    /**
     * @var \FondOfOryx\Zed\ErpOrder\Business\Model\Writer\ErpOrderAmountWriterInterface
     */
    protected $erpOrderAmountWriter;

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Business\Model\Reader\ReaderInterface
     */
    protected $erpOrderReader;

    /**
     * @param \FondOfOryx\Zed\ErpOrder\Business\Model\Writer\ErpOrderAmountWriterInterface $erpOrderAmountWriter
     * @param \FondOfOryx\Zed\ErpOrder\Business\Model\Reader\ReaderInterface $erpOrderReader
     */
    public function __construct(
        ErpOrderAmountWriterInterface $erpOrderAmountWriter,
        ReaderInterface $erpOrderReader
    ) {
        $this->erpOrderAmountWriter = $erpOrderAmountWriter;
        $this->erpOrderReader = $erpOrderReader;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderExpenseTransfer $erpOrderExpenseTransfer
     * @param \Generated\Shared\Transfer\ErpOrderTransfer|null $existingErpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderExpenseTransfer
     */
    public function handle(
        ErpOrderExpenseTransfer $erpOrderExpenseTransfer,
        ?ErpOrderTransfer $existingErpOrderTransfer = null
    ): ErpOrderExpenseTransfer {
        if ($existingErpOrderTransfer === null && $erpOrderExpenseTransfer->getFkErpOrder() !== null) {
            $existingErpOrderTransfer = $this->findErpOrderByIdErpOrder($erpOrderExpenseTransfer->getFkErpOrder());
        }

        if ($existingErpOrderTransfer === null || $existingErpOrderTransfer->getOrderExpenses()->count() === 0) {
            return $erpOrderExpenseTransfer
                ->setUnitPrice($this->createOrUpdate($erpOrderExpenseTransfer->getUnitPrice()))
                ->setAmount($this->createOrUpdate($erpOrderExpenseTransfer->getAmount()))
                ->setFkUnitPriceAmount($erpOrderExpenseTransfer->getUnitPrice()->getIdErpOrderAmount())
                ->setFkAmount($erpOrderExpenseTransfer->getAmount()->getIdErpOrderAmount());
        }

        foreach ($existingErpOrderTransfer->getOrderExpenses() as $orderExpense) {
            if ($orderExpense->getName() === $erpOrderExpenseTransfer->getName()) {
                return $erpOrderExpenseTransfer
                    ->setUnitPrice($this->createOrUpdate($erpOrderExpenseTransfer->getUnitPrice(), $orderExpense->getUnitPrice()))
                    ->setAmount($this->createOrUpdate($erpOrderExpenseTransfer->getAmount(), $orderExpense->getAmount()))
                    ->setFkUnitPriceAmount($erpOrderExpenseTransfer->getUnitPrice()->getIdErpOrderAmount())
                    ->setFkAmount($erpOrderExpenseTransfer->getAmount()->getIdErpOrderAmount());
            }
        }

        return $erpOrderExpenseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderAmountTransfer $newAmountTransfer
     * @param \Generated\Shared\Transfer\ErpOrderAmountTransfer|null $oldAmountTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderAmountTransfer
     */
    protected function createOrUpdate(
        ErpOrderAmountTransfer $newAmountTransfer,
        ?ErpOrderAmountTransfer $oldAmountTransfer = null
    ): ErpOrderAmountTransfer {
        if ($oldAmountTransfer === null) {
            return $this->erpOrderAmountWriter->create($newAmountTransfer);
        }

        $oldAmountTransfer
            ->setValue($newAmountTransfer->getValue())
            ->setTax($newAmountTransfer->getTax());

        return $this->erpOrderAmountWriter->update($oldAmountTransfer);
    }

    /**
     * @param int|null $idErpOrder
     *
     * @return \Generated\Shared\Transfer\ErpOrderTransfer|null
     */
    protected function findErpOrderByIdErpOrder(?int $idErpOrder): ?ErpOrderTransfer
    {
        return $idErpOrder === null ? $idErpOrder : $this->erpOrderReader->findErpOrderByIdErpOrder($idErpOrder);
    }
}
