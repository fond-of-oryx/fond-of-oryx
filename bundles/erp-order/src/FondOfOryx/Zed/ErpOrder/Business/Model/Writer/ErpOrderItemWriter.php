<?php

namespace FondOfOryx\Zed\ErpOrder\Business\Model\Writer;

use FondOfOryx\Zed\ErpOrder\Business\PluginExecutor\ErpOrderItemPluginExecutorInterface;
use FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderEntityManagerInterface;
use Generated\Shared\Transfer\ErpOrderItemTransfer;

class ErpOrderItemWriter implements ErpOrderItemWriterInterface
{
    /**
     * @var \FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Business\PluginExecutor\ErpOrderItemPluginExecutorInterface
     */
    protected $erpOrderItemPluginExecutor;

    /**
     * @param \FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderEntityManagerInterface $entityManager
     * @param \FondOfOryx\Zed\ErpOrder\Business\PluginExecutor\ErpOrderItemPluginExecutorInterface $erpOrderItemPluginExecutor
     */
    public function __construct(
        ErpOrderEntityManagerInterface $entityManager,
        ErpOrderItemPluginExecutorInterface $erpOrderItemPluginExecutor
    ) {
        $this->entityManager = $entityManager;
        $this->erpOrderItemPluginExecutor = $erpOrderItemPluginExecutor;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderItemTransfer $erpOrderItemTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderItemTransfer
     */
    public function create(ErpOrderItemTransfer $erpOrderItemTransfer): ErpOrderItemTransfer
    {
        $erpOrderItemTransfer = $this->erpOrderItemPluginExecutor->executePreSavePlugins($erpOrderItemTransfer);
        $erpOrderItemTransfer = $this->entityManager->createErpOrderItem($erpOrderItemTransfer);

        return $this->erpOrderItemPluginExecutor->executePostSavePlugins($erpOrderItemTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderItemTransfer $erpOrderItemTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderItemTransfer
     */
    public function update(ErpOrderItemTransfer $erpOrderItemTransfer): ErpOrderItemTransfer
    {
        $erpOrderItemTransfer
            ->requireIdErpOrderItem()
            ->requireFkErpOrder();

        $erpOrderItemTransfer = $this->erpOrderItemPluginExecutor->executePreSavePlugins($erpOrderItemTransfer);
        $erpOrderItemTransfer = $this->entityManager->updateErpOrderItem($erpOrderItemTransfer);

        return $this->erpOrderItemPluginExecutor->executePostSavePlugins($erpOrderItemTransfer);
    }

    /**
     * @param int $idErpOrderItem
     *
     * @return void
     */
    public function delete(int $idErpOrderItem): void
    {
        $this->entityManager->deleteErpOrderItemByIdErpOrderItem($idErpOrderItem);
    }
}
