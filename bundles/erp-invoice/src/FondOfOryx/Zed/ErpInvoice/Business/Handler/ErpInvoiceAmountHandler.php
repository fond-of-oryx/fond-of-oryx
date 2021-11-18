<?php

namespace FondOfOryx\Zed\ErpInvoice\Business\Handler;

use FondOfOryx\Zed\ErpInvoice\Business\Model\Reader\ErpInvoiceReaderInterface;
use FondOfOryx\Zed\ErpInvoice\Business\Model\Writer\ErpInvoiceAmountWriterInterface;
use Generated\Shared\Transfer\ErpInvoiceAmountTransfer;
use Generated\Shared\Transfer\ErpInvoiceTransfer;

class ErpInvoiceAmountHandler implements ErpInvoiceAmountHandlerInterface
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
     * @param \Generated\Shared\Transfer\ErpInvoiceTransfer $erpInvoiceTransfer
     * @param \Generated\Shared\Transfer\ErpInvoiceTransfer|null $existingErpInvoiceTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceTransfer
     */
    public function handle(ErpInvoiceTransfer $erpInvoiceTransfer, ?ErpInvoiceTransfer $existingErpInvoiceTransfer = null): ErpInvoiceTransfer
    {
        if ($existingErpInvoiceTransfer === null && $erpInvoiceTransfer->getIdErpInvoice() !== null) {
            $existingErpInvoiceTransfer = $this->findErpInvoiceById($erpInvoiceTransfer->getIdErpInvoice());
        }

        if ($existingErpInvoiceTransfer === null) {
            $totalTransfer = $erpInvoiceTransfer->getTotal();
            $erpInvoiceAmountTransfer = $this->createOrUpdate($totalTransfer);
            $erpInvoiceTransfer->setTotal($erpInvoiceAmountTransfer)->setFkTotalAmount($erpInvoiceAmountTransfer->getIdErpInvoiceAmount());

            return $erpInvoiceTransfer;
        }

        $totalTransfer = $erpInvoiceTransfer->getTotal();
        $erpInvoiceAmountTransfer = $this->createOrUpdate($totalTransfer, $existingErpInvoiceTransfer->getTotal());
        $erpInvoiceTransfer->setTotal($erpInvoiceAmountTransfer)->setFkTotalAmount($erpInvoiceAmountTransfer->getIdErpInvoiceAmount());

        return $erpInvoiceTransfer;
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
    protected function findErpInvoiceById(?int $idErpInvoice): ?ErpInvoiceTransfer
    {
        return $idErpInvoice === null ? $idErpInvoice : $this->erpInvoiceReader->findErpInvoiceByIdErpInvoice($idErpInvoice);
    }
}
