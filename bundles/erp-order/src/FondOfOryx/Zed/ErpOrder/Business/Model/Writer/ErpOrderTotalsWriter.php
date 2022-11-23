<?php

namespace FondOfOryx\Zed\ErpOrder\Business\Model\Writer;

use FondOfOryx\Zed\ErpOrder\Business\PluginExecutor\ErpOrderTotalsPluginExecutorInterface;
use FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderEntityManagerInterface;
use Generated\Shared\Transfer\ErpOrderTotalsTransfer;

class ErpOrderTotalsWriter implements ErpOrderTotalsWriterInterface
{
    /**
     * @var \FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Business\PluginExecutor\ErpOrderTotalsPluginExecutorInterface
     */
    protected $erpOrderTotalsPluginExecutor;

    /**
     * @param \FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderEntityManagerInterface $entityManager
     * @param \FondOfOryx\Zed\ErpOrder\Business\PluginExecutor\ErpOrderTotalsPluginExecutorInterface $erpOrderTotalsPluginExecutor
     */
    public function __construct(
        ErpOrderEntityManagerInterface $entityManager,
        ErpOrderTotalsPluginExecutorInterface $erpOrderTotalsPluginExecutor
    ) {
        $this->entityManager = $entityManager;
        $this->erpOrderTotalsPluginExecutor = $erpOrderTotalsPluginExecutor;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderTotalsTransfer $erpOrderTotalsTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderTotalsTransfer
     */
    public function create(ErpOrderTotalsTransfer $erpOrderTotalsTransfer): ErpOrderTotalsTransfer
    {
        $erpOrderTotalsTransfer = $this->erpOrderTotalsPluginExecutor->executePreSavePlugins($erpOrderTotalsTransfer);
        $erpOrderTotalsTransfer = $this->entityManager->createErpOrderTotals($erpOrderTotalsTransfer);

        return $this->erpOrderTotalsPluginExecutor->executePostSavePlugins($erpOrderTotalsTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderTotalsTransfer $erpOrderTotalsTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderTotalsTransfer
     */
    public function update(ErpOrderTotalsTransfer $erpOrderTotalsTransfer): ErpOrderTotalsTransfer
    {
        $erpOrderTotalsTransfer = $this->erpOrderTotalsPluginExecutor->executePreSavePlugins($erpOrderTotalsTransfer);
        $erpOrderTotalsTransfer = $this->entityManager->updateErpOrderTotals($erpOrderTotalsTransfer);

        return $this->erpOrderTotalsPluginExecutor->executePostSavePlugins($erpOrderTotalsTransfer);
    }

    /**
     * @param int $idErpOrderTotals
     *
     * @return void
     */
    public function delete(int $idErpOrderTotals): void
    {
        $this->entityManager->deleteErpOrderTotalsByIdErpOrderTotals($idErpOrderTotals);
    }
}
