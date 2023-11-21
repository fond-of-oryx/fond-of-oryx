<?php

namespace FondOfOryx\Zed\ErpOrder\Business\Handler;

use FondOfOryx\Zed\ErpOrder\Business\Model\Reader\ReaderInterface;
use FondOfOryx\Zed\ErpOrder\Business\Model\Writer\ErpOrderAmountWriterInterface;
use Generated\Shared\Transfer\ErpOrderAmountTransfer;
use Generated\Shared\Transfer\ErpOrderItemTransfer;
use Generated\Shared\Transfer\ErpOrderTransfer;

class ErpOrderItemAmountHandler implements ErpOrderItemAmountHandlerInterface
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
     * @param \Generated\Shared\Transfer\ErpOrderItemTransfer $erpOrderItemTransfer
     * @param \Generated\Shared\Transfer\ErpOrderTransfer|null $existingErpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderItemTransfer
     */
    public function handle(ErpOrderItemTransfer $erpOrderItemTransfer, ?ErpOrderTransfer $existingErpOrderTransfer = null): ErpOrderItemTransfer
    {
        if ($existingErpOrderTransfer === null && $erpOrderItemTransfer->getFkErpOrder() !== null) {
            $existingErpOrderTransfer = $this->findErpOrderByIdErpOrder($erpOrderItemTransfer->getFkErpOrder());
        }

        if ($existingErpOrderTransfer === null || $existingErpOrderTransfer->getOrderItems()->count() === 0) {
            return $erpOrderItemTransfer
                ->setUnitPrice($this->createOrUpdate($erpOrderItemTransfer->getUnitPrice()))
                ->setAmount($this->createOrUpdate($erpOrderItemTransfer->getAmount()))
                ->setFkUnitPriceAmount($erpOrderItemTransfer->getUnitPrice()->getIdErpOrderAmount())
                ->setFkAmount($erpOrderItemTransfer->getAmount()->getIdErpOrderAmount());
        }

        foreach ($existingErpOrderTransfer->getOrderItems() as $orderItem) {
            if ($orderItem->getSku() === $erpOrderItemTransfer->getSku()) {
                return $erpOrderItemTransfer
                    ->setUnitPrice($this->createOrUpdate($erpOrderItemTransfer->getUnitPrice(), $orderItem->getUnitPrice()))
                    ->setAmount($this->createOrUpdate($erpOrderItemTransfer->getAmount(), $orderItem->getAmount()))
                    ->setFkUnitPriceAmount($erpOrderItemTransfer->getUnitPrice()->getIdErpOrderAmount())
                    ->setFkAmount($erpOrderItemTransfer->getAmount()->getIdErpOrderAmount());
            }
        }

        return $erpOrderItemTransfer;
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
