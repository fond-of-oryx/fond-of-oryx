<?php

namespace FondOfOryx\Zed\ErpOrder\Business\Model\Writer;

use FondOfOryx\Zed\ErpOrder\Business\PluginExecutor\ErpOrderItemPluginExecutorInterface;
use FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderEntityManagerInterface;
use Generated\Shared\Transfer\ErpOrderItemTransfer;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionTrait;

class ErpOrderItemWriter implements ErpOrderItemWriterInterface
{
    use TransactionTrait;

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
        $self = $this;
        $erpOrderItemTransfer = $this->getTransactionHandler()->handleTransaction(
            static function () use ($erpOrderItemTransfer, $self) {
                return $self->executePersistTransaction($erpOrderItemTransfer);
            }
        );

        return $erpOrderItemTransfer;
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

        $self = $this;
        $erpOrderItemTransfer = $this->getTransactionHandler()->handleTransaction(
            static function () use ($erpOrderItemTransfer, $self) {
                return $self->executeUpdateTransaction($erpOrderItemTransfer);
            }
        );

        return $erpOrderItemTransfer;
    }

    /**
     * @param int $idErpOrderItem
     *
     * @return void
     */
    public function delete(int $idErpOrderItem): void
    {
        $self = $this;
        $this->getTransactionHandler()->handleTransaction(
            static function () use ($idErpOrderItem, $self) {
                $self->executeDeleteTransaction($idErpOrderItem);
            }
        );
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderItemTransfer $erpOrderItemTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderItemTransfer
     */
    protected function executePersistTransaction(
        ErpOrderItemTransfer $erpOrderItemTransfer
    ): ErpOrderItemTransfer {
        $erpOrderItemTransfer = $this->erpOrderItemPluginExecutor->executePreSavePlugins($erpOrderItemTransfer);
        $erpOrderItemTransfer = $this->entityManager->createErpOrderItem($erpOrderItemTransfer);
        $erpOrderItemTransfer = $this->erpOrderItemPluginExecutor->executePostSavePlugins($erpOrderItemTransfer);

        return $erpOrderItemTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderItemTransfer $erpOrderItemTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderItemTransfer
     */
    protected function executeUpdateTransaction(
        ErpOrderItemTransfer $erpOrderItemTransfer
    ): ErpOrderItemTransfer {
        $erpOrderItemTransfer = $this->erpOrderItemPluginExecutor->executePreSavePlugins($erpOrderItemTransfer);
        $erpOrderItemTransfer = $this->entityManager->updateErpOrderItem($erpOrderItemTransfer);
        $erpOrderItemTransfer = $this->erpOrderItemPluginExecutor->executePostSavePlugins($erpOrderItemTransfer);

        return $erpOrderItemTransfer;
    }

    /**
     * @param int $idErpOrderItem
     *
     * @return void
     */
    protected function executeDeleteTransaction(int $idErpOrderItem): void
    {
        $this->entityManager->deleteErpOrderItemByIdErpOrderItem($idErpOrderItem);
    }
}
