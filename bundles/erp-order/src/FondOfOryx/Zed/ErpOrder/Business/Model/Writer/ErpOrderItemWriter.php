<?php

namespace FondOfOryx\Zed\ErpOrder\Business\Model\Writer;

use Exception;
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
        try {
            $erpOrderItemTransfer = $this->getTransactionHandler()->handleTransaction(
                function () use ($erpOrderItemTransfer, $self) {
                    return $self->executePersistTransaction($erpOrderItemTransfer);
                }
            );
        } catch (Exception $exception) {
            //ToDo Maybe logging
            throw new $exception();
        }

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
        try {
            $erpOrderItemTransfer = $this->getTransactionHandler()->handleTransaction(
                function () use ($erpOrderItemTransfer, $self) {
                    return $self->executeUpdateTransaction($erpOrderItemTransfer);
                }
            );
        } catch (Exception $exception) {
            //ToDo Maybe logging
            throw new $exception();
        }

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
        try {
            $this->getTransactionHandler()->handleTransaction(
                function () use ($idErpOrderItem, $self) {
                    return $self->executeDeleteTransaction($idErpOrderItem);
                }
            );
        } catch (Exception $exception) {
            //ToDo Maybe logging
            throw new $exception();
        }
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
        $erpOrderItemTransfer = $this->erpOrderItemPluginExecutor->executePreSavePlugins($erpOrderItemTransfer);

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
        $erpOrderItemTransfer = $this->erpOrderItemPluginExecutor->executePreSavePlugins($erpOrderItemTransfer);

        return $erpOrderItemTransfer;
    }

    /**
     * @param int $idErpOrderItem
     *
     * @return void
     */
    protected function executeDeleteTransaction(int $idErpOrderItem): void
    {
        $this->entityManager->deleteErpOrderByIdErpOrder($idErpOrderItem);
    }
}
