<?php

namespace FondOfOryx\Zed\ErpOrder\Business\Model\Writer;

use FondOfOryx\Zed\ErpOrder\Business\PluginExecutor\ErpOrderExpensePluginExecutorInterface;
use FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderEntityManagerInterface;
use Generated\Shared\Transfer\ErpOrderExpenseTransfer;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionTrait;

class ErpOrderExpenseWriter implements ErpOrderExpenseWriterInterface
{
    use TransactionTrait;

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Business\PluginExecutor\ErpOrderExpensePluginExecutorInterface
     */
    protected $erpOrderExpensePluginExecutor;

    /**
     * @param \FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderEntityManagerInterface $entityManager
     * @param \FondOfOryx\Zed\ErpOrder\Business\PluginExecutor\ErpOrderExpensePluginExecutorInterface $erpOrderExpensePluginExecutor
     */
    public function __construct(
        ErpOrderEntityManagerInterface $entityManager,
        ErpOrderExpensePluginExecutorInterface $erpOrderExpensePluginExecutor
    ) {
        $this->entityManager = $entityManager;
        $this->erpOrderExpensePluginExecutor = $erpOrderExpensePluginExecutor;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderExpenseTransfer $erpOrderExpenseTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderExpenseTransfer
     */
    public function create(ErpOrderExpenseTransfer $erpOrderExpenseTransfer): ErpOrderExpenseTransfer
    {
        $self = $this;
        $erpOrderExpenseTransfer = $this->getTransactionHandler()->handleTransaction(
            static function () use ($erpOrderExpenseTransfer, $self) {
                return $self->executePersistTransaction($erpOrderExpenseTransfer);
            },
        );

        return $erpOrderExpenseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderExpenseTransfer $erpOrderExpenseTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderExpenseTransfer
     */
    public function update(ErpOrderExpenseTransfer $erpOrderExpenseTransfer): ErpOrderExpenseTransfer
    {
        $erpOrderExpenseTransfer
            ->requireIdErpOrderExpense()
            ->requireFkErpOrder();

        $self = $this;
        $erpOrderExpenseTransfer = $this->getTransactionHandler()->handleTransaction(
            static function () use ($erpOrderExpenseTransfer, $self) {
                return $self->executeUpdateTransaction($erpOrderExpenseTransfer);
            },
        );

        return $erpOrderExpenseTransfer;
    }

    /**
     * @param int $idErpOrderExpense
     *
     * @return void
     */
    public function delete(int $idErpOrderExpense): void
    {
        $self = $this;
        $this->getTransactionHandler()->handleTransaction(
            static function () use ($idErpOrderExpense, $self) {
                $self->executeDeleteTransaction($idErpOrderExpense);
            },
        );
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderExpenseTransfer $erpOrderExpenseTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderExpenseTransfer
     */
    protected function executePersistTransaction(
        ErpOrderExpenseTransfer $erpOrderExpenseTransfer
    ): ErpOrderExpenseTransfer {
        $erpOrderExpenseTransfer = $this->erpOrderExpensePluginExecutor->executePreSavePlugins($erpOrderExpenseTransfer);
        $erpOrderExpenseTransfer = $this->entityManager->createErpOrderExpense($erpOrderExpenseTransfer);
        $erpOrderExpenseTransfer = $this->erpOrderExpensePluginExecutor->executePostSavePlugins($erpOrderExpenseTransfer);

        return $erpOrderExpenseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderExpenseTransfer $erpOrderExpenseTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderExpenseTransfer
     */
    protected function executeUpdateTransaction(
        ErpOrderExpenseTransfer $erpOrderExpenseTransfer
    ): ErpOrderExpenseTransfer {
        $erpOrderExpenseTransfer = $this->erpOrderExpensePluginExecutor->executePreSavePlugins($erpOrderExpenseTransfer);
        $erpOrderExpenseTransfer = $this->entityManager->updateErpOrderExpense($erpOrderExpenseTransfer);
        $erpOrderExpenseTransfer = $this->erpOrderExpensePluginExecutor->executePostSavePlugins($erpOrderExpenseTransfer);

        return $erpOrderExpenseTransfer;
    }

    /**
     * @param int $idErpOrderExpense
     *
     * @return void
     */
    protected function executeDeleteTransaction(int $idErpOrderExpense): void
    {
        $this->entityManager->deleteErpOrderExpenseByIdErpOrderExpense($idErpOrderExpense);
    }
}
