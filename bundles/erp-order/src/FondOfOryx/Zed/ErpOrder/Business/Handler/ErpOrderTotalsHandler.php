<?php

namespace FondOfOryx\Zed\ErpOrder\Business\Handler;

use FondOfOryx\Zed\ErpOrder\Business\Model\Reader\ErpOrderTotalsReaderInterface;
use FondOfOryx\Zed\ErpOrder\Business\Model\Writer\ErpOrderTotalsWriterInterface;
use Generated\Shared\Transfer\ErpOrderTotalsTransfer;
use Generated\Shared\Transfer\ErpOrderTransfer;

class ErpOrderTotalsHandler implements ErpOrderTotalsHandlerInterface
{
    /**
     * @var \FondOfOryx\Zed\ErpOrder\Business\Model\Reader\ErpOrderTotalsReaderInterface
     */
    protected $erpOrderTotalsReader;

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Business\Model\Writer\ErpOrderTotalsWriterInterface
     */
    protected $erpOrderTotalsWriter;

    /**
     * @param \FondOfOryx\Zed\ErpOrder\Business\Model\Reader\ErpOrderTotalsReaderInterface $erpOrderTotalsReader
     * @param \FondOfOryx\Zed\ErpOrder\Business\Model\Writer\ErpOrderTotalsWriterInterface $erpOrderTotalsWriter
     */
    public function __construct(
        ErpOrderTotalsReaderInterface $erpOrderTotalsReader,
        ErpOrderTotalsWriterInterface $erpOrderTotalsWriter
    ) {
        $this->erpOrderTotalsReader = $erpOrderTotalsReader;
        $this->erpOrderTotalsWriter = $erpOrderTotalsWriter;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderTransfer $erpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderTransfer
     */
    public function handle(ErpOrderTransfer $erpOrderTransfer): ErpOrderTransfer
    {
        $erpOrderTotalsTransfer = $erpOrderTransfer->getTotals();

        if ($erpOrderTotalsTransfer === null) {
            return $erpOrderTransfer;
        }

        if ($erpOrderTotalsTransfer->getIdErpOrderTotals() === null) {
            $erpOrderTotalsTransfer = $this->create($erpOrderTotalsTransfer);

            return $erpOrderTransfer->setTotals($erpOrderTotalsTransfer)
                ->setFkTotals($erpOrderTotalsTransfer->getIdErpOrderTotals());
        }

        $erpOrderTotalsTransfer = $this->update($erpOrderTotalsTransfer);

        return $erpOrderTransfer->setTotals($erpOrderTotalsTransfer)
            ->setFkTotals($erpOrderTotalsTransfer->getIdErpOrderTotals());
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderTotalsTransfer $erpOrderTotalsTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderTotalsTransfer
     */
    protected function create(ErpOrderTotalsTransfer $erpOrderTotalsTransfer): ErpOrderTotalsTransfer
    {
        return $this->erpOrderTotalsWriter->create($erpOrderTotalsTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderTotalsTransfer $erpOrderTotalsTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderTotalsTransfer
     */
    protected function update(ErpOrderTotalsTransfer $erpOrderTotalsTransfer): ErpOrderTotalsTransfer
    {
        $erpOrderTotalsTransfer->requireIdErpOrderTotals();

        $existingErpOrderTotalsTransfer = $this->erpOrderTotalsReader->finderpOrderTotalsByIderpOrderTotals(
            $erpOrderTotalsTransfer->getIdErpOrderTotals(),
        );

        $existingErpOrderTotalsTransfer->fromArray($erpOrderTotalsTransfer->toArray(), true);

        return $this->erpOrderTotalsWriter->update($existingErpOrderTotalsTransfer);
    }
}
