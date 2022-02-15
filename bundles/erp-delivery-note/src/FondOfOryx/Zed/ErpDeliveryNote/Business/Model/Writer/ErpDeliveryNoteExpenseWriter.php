<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Writer;

use FondOfOryx\Zed\ErpDeliveryNote\Business\PluginExecutor\ErpDeliveryNoteExpensePluginExecutorInterface;
use FondOfOryx\Zed\ErpDeliveryNote\Persistence\ErpDeliveryNoteEntityManagerInterface;
use Generated\Shared\Transfer\ErpDeliveryNoteExpenseTransfer;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionTrait;

class ErpDeliveryNoteExpenseWriter implements ErpDeliveryNoteExpenseWriterInterface
{
    use TransactionTrait;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Persistence\ErpDeliveryNoteEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Business\PluginExecutor\ErpDeliveryNoteExpensePluginExecutorInterface
     */
    protected $erpDeliveryNoteExpensePluginExecutor;

    /**
     * @param \FondOfOryx\Zed\ErpDeliveryNote\Persistence\ErpDeliveryNoteEntityManagerInterface $entityManager
     * @param \FondOfOryx\Zed\ErpDeliveryNote\Business\PluginExecutor\ErpDeliveryNoteExpensePluginExecutorInterface $erpDeliveryNoteExpensePluginExecutor
     */
    public function __construct(
        ErpDeliveryNoteEntityManagerInterface $entityManager,
        ErpDeliveryNoteExpensePluginExecutorInterface $erpDeliveryNoteExpensePluginExecutor
    ) {
        $this->entityManager = $entityManager;
        $this->erpDeliveryNoteExpensePluginExecutor = $erpDeliveryNoteExpensePluginExecutor;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteExpenseTransfer $erpDeliveryNoteExpenseTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteExpenseTransfer
     */
    public function create(ErpDeliveryNoteExpenseTransfer $erpDeliveryNoteExpenseTransfer): ErpDeliveryNoteExpenseTransfer
    {
        $self = $this;
        $erpDeliveryNoteExpenseTransfer = $this->getTransactionHandler()->handleTransaction(
            static function () use ($erpDeliveryNoteExpenseTransfer, $self) {
                return $self->executePersistTransaction($erpDeliveryNoteExpenseTransfer);
            },
        );

        return $erpDeliveryNoteExpenseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteExpenseTransfer $erpDeliveryNoteExpenseTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteExpenseTransfer
     */
    public function update(ErpDeliveryNoteExpenseTransfer $erpDeliveryNoteExpenseTransfer): ErpDeliveryNoteExpenseTransfer
    {
        $erpDeliveryNoteExpenseTransfer
            ->requireIdErpDeliveryNoteExpense()
            ->requireFkErpDeliveryNote();

        $self = $this;
        $erpDeliveryNoteExpenseTransfer = $this->getTransactionHandler()->handleTransaction(
            static function () use ($erpDeliveryNoteExpenseTransfer, $self) {
                return $self->executeUpdateTransaction($erpDeliveryNoteExpenseTransfer);
            },
        );

        return $erpDeliveryNoteExpenseTransfer;
    }

    /**
     * @param int $idErpDeliveryNoteExpense
     *
     * @return void
     */
    public function delete(int $idErpDeliveryNoteExpense): void
    {
        $self = $this;
        $this->getTransactionHandler()->handleTransaction(
            static function () use ($idErpDeliveryNoteExpense, $self) {
                $self->executeDeleteTransaction($idErpDeliveryNoteExpense);
            },
        );
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteExpenseTransfer $erpDeliveryNoteExpenseTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteExpenseTransfer
     */
    protected function executePersistTransaction(
        ErpDeliveryNoteExpenseTransfer $erpDeliveryNoteExpenseTransfer
    ): ErpDeliveryNoteExpenseTransfer {
        $erpDeliveryNoteExpenseTransfer = $this->erpDeliveryNoteExpensePluginExecutor->executePreSavePlugins($erpDeliveryNoteExpenseTransfer);
        $erpDeliveryNoteExpenseTransfer = $this->entityManager->createErpDeliveryNoteExpense($erpDeliveryNoteExpenseTransfer);
        $erpDeliveryNoteExpenseTransfer = $this->erpDeliveryNoteExpensePluginExecutor->executePostSavePlugins($erpDeliveryNoteExpenseTransfer);

        return $erpDeliveryNoteExpenseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteExpenseTransfer $erpDeliveryNoteExpenseTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteExpenseTransfer
     */
    protected function executeUpdateTransaction(
        ErpDeliveryNoteExpenseTransfer $erpDeliveryNoteExpenseTransfer
    ): ErpDeliveryNoteExpenseTransfer {
        $erpDeliveryNoteExpenseTransfer = $this->erpDeliveryNoteExpensePluginExecutor->executePreSavePlugins($erpDeliveryNoteExpenseTransfer);
        $erpDeliveryNoteExpenseTransfer = $this->entityManager->updateErpDeliveryNoteExpense($erpDeliveryNoteExpenseTransfer);
        $erpDeliveryNoteExpenseTransfer = $this->erpDeliveryNoteExpensePluginExecutor->executePostSavePlugins($erpDeliveryNoteExpenseTransfer);

        return $erpDeliveryNoteExpenseTransfer;
    }

    /**
     * @param int $idErpDeliveryNoteExpense
     *
     * @return void
     */
    protected function executeDeleteTransaction(int $idErpDeliveryNoteExpense): void
    {
        $this->entityManager->deleteErpDeliveryNoteExpenseByIdErpDeliveryNoteExpense($idErpDeliveryNoteExpense);
    }
}
