<?php

namespace FondOfOryx\Zed\ErpInvoice\Business\Handler;

use FondOfOryx\Zed\ErpInvoice\Business\Model\Reader\ErpInvoiceReaderInterface;
use FondOfOryx\Zed\ErpInvoice\Business\Model\Writer\ErpInvoiceAmountWriterInterface;
use Generated\Shared\Transfer\ErpInvoiceAmountTransfer;
use Generated\Shared\Transfer\ErpInvoiceItemTransfer;
use Generated\Shared\Transfer\ErpInvoiceTransfer;

class ErpInvoiceItemAmountHandler implements ErpInvoiceItemAmountHandlerInterface
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
     * @param \Generated\Shared\Transfer\ErpInvoiceItemTransfer $erpInvoiceItemTransfer
     * @param \Generated\Shared\Transfer\ErpInvoiceTransfer|null $existingErpInvoiceTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceItemTransfer
     */
    public function handle(ErpInvoiceItemTransfer $erpInvoiceItemTransfer, ?ErpInvoiceTransfer $existingErpInvoiceTransfer = null): ErpInvoiceItemTransfer
    {
        if ($existingErpInvoiceTransfer === null && $erpInvoiceItemTransfer->getFkErpInvoice() !== null) {
            $existingErpInvoiceTransfer = $this->findErpInvoiceByIdErpInvoice($erpInvoiceItemTransfer->getFkErpInvoice());
        }

        if ($existingErpInvoiceTransfer === null || $existingErpInvoiceTransfer->getInvoiceItems()->count() === 0) {
            return $erpInvoiceItemTransfer
                ->setUnitPrice($this->createOrUpdate($erpInvoiceItemTransfer->getUnitPrice()))
                ->setAmount($this->createOrUpdate($erpInvoiceItemTransfer->getAmount()))
                ->setFkUnitPriceAmount($erpInvoiceItemTransfer->getUnitPrice()->getIdErpInvoiceAmount())
                ->setFkAmount($erpInvoiceItemTransfer->getAmount()->getIdErpInvoiceAmount());
        }

        foreach ($existingErpInvoiceTransfer->getInvoiceItems() as $invoiceItem) {
            if ($invoiceItem->getSku() === $erpInvoiceItemTransfer->getSku()) {
                return $erpInvoiceItemTransfer
                    ->setUnitPrice($this->createOrUpdate($erpInvoiceItemTransfer->getUnitPrice(), $invoiceItem->getUnitPrice()))
                    ->setAmount($this->createOrUpdate($erpInvoiceItemTransfer->getAmount(), $invoiceItem->getAmount()))
                    ->setFkUnitPriceAmount($erpInvoiceItemTransfer->getUnitPrice()->getIdErpInvoiceAmount())
                    ->setFkAmount($erpInvoiceItemTransfer->getAmount()->getIdErpInvoiceAmount());
            }
        }

        return $erpInvoiceItemTransfer;
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
