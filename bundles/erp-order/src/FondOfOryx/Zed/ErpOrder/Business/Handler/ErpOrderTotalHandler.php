<?php

namespace FondOfOryx\Zed\ErpOrder\Business\Handler;

use FondOfOryx\Zed\ErpOrder\Business\Model\Reader\ErpOrderTotalReaderInterface;
use FondOfOryx\Zed\ErpOrder\Business\Model\Writer\ErpOrderTotalWriterInterface;
use Generated\Shared\Transfer\ErpOrderTotalTransfer;
use Generated\Shared\Transfer\ErpOrderTransfer;

class ErpOrderTotalHandler implements ErpOrderTotalHandlerInterface
{
    /**
     * @var \FondOfOryx\Zed\ErpOrder\Business\Model\Writer\ErpOrderTotalWriterInterface
     */
    protected $erpOrderTotalWriter;

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Business\Model\Reader\ErpOrderTotalReaderInterface
     */
    protected $erpOrderTotalReader;

    /**
     * @param \FondOfOryx\Zed\ErpOrder\Business\Model\Writer\ErpOrderTotalWriterInterface $erpOrderTotalWriter
     * @param \FondOfOryx\Zed\ErpOrder\Business\Model\Reader\ErpOrderTotalReaderInterface $erpOrderTotalReader
     */
    public function __construct(
        ErpOrderTotalWriterInterface $erpOrderTotalWriter,
        ErpOrderTotalReaderInterface $erpOrderTotalReader
    ) {
        $this->erpOrderTotalWriter = $erpOrderTotalWriter;
        $this->erpOrderTotalReader = $erpOrderTotalReader;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderTransfer $erpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderTransfer
     */
    public function handle(ErpOrderTransfer $erpOrderTransfer): ErpOrderTransfer
    {
        if ($erpOrderTransfer->getIdErpOrder() === null) {
            return $erpOrderTransfer;
        }

        $erpOrderTotalTransfer = $this->findErpOrderTotal($erpOrderTransfer->getIdErpOrder());

        if ($erpOrderTotalTransfer === null) {
            $erpOrderTotalTransfer = $erpOrderTransfer->getTotal()
                ->setFkErpOrder($erpOrderTransfer->getIdErpOrder());

            $erpOrderTotalTransfer = $this->create($erpOrderTotalTransfer);
        } else {
            $erpOrderTotalTransfer = $this->update($erpOrderTotalTransfer->fromArray(
                $erpOrderTransfer->getTotal()->modifiedToArray(),
                true
            ));
        }

        return $erpOrderTransfer->setTotal($erpOrderTotalTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderTotalTransfer $erpOrderTotalTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderTotalTransfer
     */
    protected function create(ErpOrderTotalTransfer $erpOrderTotalTransfer): ErpOrderTotalTransfer
    {
        return $this->erpOrderTotalWriter->create($erpOrderTotalTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderTotalTransfer $erpOrderTotalTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderTotalTransfer
     */
    protected function update(ErpOrderTotalTransfer $erpOrderTotalTransfer): ErpOrderTotalTransfer
    {
        $erpOrderTotalTransfer->requireIdErpOrderTotal();

        $total = $this->erpOrderTotalReader->findErpOrderTotalByIdErpOrderTotal($erpOrderTotalTransfer->getIdErpOrderTotal());
        $total->fromArray($erpOrderTotalTransfer->toArray(), true);

        return $this->erpOrderTotalWriter->update($total);
    }

    /**
     * @param int $idErpOrder
     *
     * @return \Generated\Shared\Transfer\ErpOrderTotalTransfer|null
     */
    protected function findErpOrderTotal(int $idErpOrder): ?ErpOrderTotalTransfer
    {
        return $this->erpOrderTotalReader->findErpOrderTotalByIdErpOrder($idErpOrder);
    }
}
