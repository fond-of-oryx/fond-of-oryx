<?php

namespace FondOfOryx\Zed\ErpInvoice\Business\Handler;

use FondOfOryx\Zed\ErpInvoice\Business\Model\Reader\ErpInvoiceReaderInterface;
use FondOfOryx\Zed\ErpInvoice\Business\Model\Writer\ErpInvoiceAmountWriterInterface;
use Generated\Shared\Transfer\ErpInvoiceAmountTransfer;
use Generated\Shared\Transfer\ErpInvoiceExpenseTransfer;
use Generated\Shared\Transfer\ErpInvoiceTransfer;

class ErpInvoiceExpenseAmountHandler implements ErpInvoiceExpenseAmountHandlerInterface
{
    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Business\Model\Writer\ErpInvoiceAmountWriterInterface
     */
    protected $erpInvoiceAmountWriter;

    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Business\Model\Reader\ErpInvoiceReaderInterface
     */
    protected $erpInvoiceReader;

    /**
     * @param \FondOfOryx\Zed\ErpInvoice\Business\Model\Writer\ErpInvoiceAmountWriterInterface $erpInvoiceAmountWriter
     * @param \FondOfOryx\Zed\ErpInvoice\Business\Model\Reader\ErpInvoiceReaderInterface $erpInvoiceReader
     */
    public function __construct(
        ErpInvoiceAmountWriterInterface $erpInvoiceAmountWriter,
        ErpInvoiceReaderInterface $erpInvoiceReader
    ) {
        $this->erpInvoiceAmountWriter = $erpInvoiceAmountWriter;
        $this->erpInvoiceReader = $erpInvoiceReader;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceExpenseTransfer $erpInvoiceExpenseTransfer
     * @param \Generated\Shared\Transfer\ErpInvoiceTransfer|null $existingErpInvoiceTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceExpenseTransfer
     */
    public function handle(
        ErpInvoiceExpenseTransfer $erpInvoiceExpenseTransfer,
        ?ErpInvoiceTransfer $existingErpInvoiceTransfer = null
    ): ErpInvoiceExpenseTransfer {
        if ($existingErpInvoiceTransfer === null && $erpInvoiceExpenseTransfer->getFkErpInvoice() !== null) {
            $existingErpInvoiceTransfer = $this->findErpInvoiceByIdErpInvoice($erpInvoiceExpenseTransfer->getFkErpInvoice());
        }

        if ($existingErpInvoiceTransfer === null || $existingErpInvoiceTransfer->getExpenses()->count() === 0) {
            return $erpInvoiceExpenseTransfer
                ->setUnitPrice($this->createOrUpdate($erpInvoiceExpenseTransfer->getUnitPrice()))
                ->setAmount($this->createOrUpdate($erpInvoiceExpenseTransfer->getAmount()))
                ->setFkUnitPriceAmount($erpInvoiceExpenseTransfer->getUnitPrice()->getIdErpInvoiceAmount())
                ->setFkAmount($erpInvoiceExpenseTransfer->getAmount()->getIdErpInvoiceAmount());
        }

        foreach ($existingErpInvoiceTransfer->getExpenses() as $invoiceExpense) {
            if ($invoiceExpense->getName() === $erpInvoiceExpenseTransfer->getName()) {
                return $erpInvoiceExpenseTransfer
                    ->setUnitPrice($this->createOrUpdate($erpInvoiceExpenseTransfer->getUnitPrice(), $invoiceExpense->getUnitPrice()))
                    ->setAmount($this->createOrUpdate($erpInvoiceExpenseTransfer->getAmount(), $invoiceExpense->getAmount()))
                    ->setFkUnitPriceAmount($erpInvoiceExpenseTransfer->getUnitPrice()->getIdErpInvoiceAmount())
                    ->setFkAmount($erpInvoiceExpenseTransfer->getAmount()->getIdErpInvoiceAmount());
            }
        }

        return $erpInvoiceExpenseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceAmountTransfer $newAmountTransfer
     * @param \Generated\Shared\Transfer\ErpInvoiceAmountTransfer|null $oldAmountTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceAmountTransfer
     */
    protected function createOrUpdate(
        ErpInvoiceAmountTransfer $newAmountTransfer,
        ?ErpInvoiceAmountTransfer $oldAmountTransfer = null
    ): ErpInvoiceAmountTransfer {
        if ($oldAmountTransfer === null) {
            return $this->erpInvoiceAmountWriter->create($newAmountTransfer);
        }

        $oldAmountTransfer
            ->setValue($newAmountTransfer->getValue())
            ->setTax($newAmountTransfer->getTax());

        return $this->erpInvoiceAmountWriter->update($oldAmountTransfer);
    }

    /**
     * @param int|null $idErpInvoice
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceTransfer|null
     */
    protected function findErpInvoiceByIdErpInvoice(?int $idErpInvoice): ?ErpInvoiceTransfer
    {
        return $idErpInvoice === null ? $idErpInvoice : $this->erpInvoiceReader->findErpInvoiceByIdErpInvoice($idErpInvoice);
    }
}
