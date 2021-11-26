<?php

namespace FondOfOryx\Zed\ErpInvoice\Business\Model\Writer;

use FondOfOryx\Zed\ErpInvoice\Business\PluginExecutor\ErpInvoiceExpensePluginExecutorInterface;
use FondOfOryx\Zed\ErpInvoice\Persistence\ErpInvoiceEntityManagerInterface;
use Generated\Shared\Transfer\ErpInvoiceExpenseTransfer;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionTrait;

class ErpInvoiceExpenseWriter implements ErpInvoiceExpenseWriterInterface
{
    use TransactionTrait;

    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Persistence\ErpInvoiceEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Business\PluginExecutor\ErpInvoiceExpensePluginExecutorInterface
     */
    protected $erpInvoiceExpensePluginExecutor;

    /**
     * @param \FondOfOryx\Zed\ErpInvoice\Persistence\ErpInvoiceEntityManagerInterface $entityManager
     * @param \FondOfOryx\Zed\ErpInvoice\Business\PluginExecutor\ErpInvoiceExpensePluginExecutorInterface $erpInvoiceExpensePluginExecutor
     */
    public function __construct(
        ErpInvoiceEntityManagerInterface $entityManager,
        ErpInvoiceExpensePluginExecutorInterface $erpInvoiceExpensePluginExecutor
    ) {
        $this->entityManager = $entityManager;
        $this->erpInvoiceExpensePluginExecutor = $erpInvoiceExpensePluginExecutor;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceExpenseTransfer $erpInvoiceExpenseTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceExpenseTransfer
     */
    public function create(ErpInvoiceExpenseTransfer $erpInvoiceExpenseTransfer): ErpInvoiceExpenseTransfer
    {
        $self = $this;
        $erpInvoiceExpenseTransfer = $this->getTransactionHandler()->handleTransaction(
            static function () use ($erpInvoiceExpenseTransfer, $self) {
                return $self->executePersistTransaction($erpInvoiceExpenseTransfer);
            },
        );

        return $erpInvoiceExpenseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceExpenseTransfer $erpInvoiceExpenseTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceExpenseTransfer
     */
    public function update(ErpInvoiceExpenseTransfer $erpInvoiceExpenseTransfer): ErpInvoiceExpenseTransfer
    {
        $erpInvoiceExpenseTransfer
            ->requireIdErpInvoiceExpense()
            ->requireFkErpInvoice();

        $self = $this;
        $erpInvoiceExpenseTransfer = $this->getTransactionHandler()->handleTransaction(
            static function () use ($erpInvoiceExpenseTransfer, $self) {
                return $self->executeUpdateTransaction($erpInvoiceExpenseTransfer);
            },
        );

        return $erpInvoiceExpenseTransfer;
    }

    /**
     * @param int $idErpInvoiceExpense
     *
     * @return void
     */
    public function delete(int $idErpInvoiceExpense): void
    {
        $self = $this;
        $this->getTransactionHandler()->handleTransaction(
            static function () use ($idErpInvoiceExpense, $self) {
                $self->executeDeleteTransaction($idErpInvoiceExpense);
            },
        );
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceExpenseTransfer $erpInvoiceExpenseTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceExpenseTransfer
     */
    protected function executePersistTransaction(
        ErpInvoiceExpenseTransfer $erpInvoiceExpenseTransfer
    ): ErpInvoiceExpenseTransfer {
        $erpInvoiceExpenseTransfer = $this->erpInvoiceExpensePluginExecutor->executePreSavePlugins($erpInvoiceExpenseTransfer);
        $erpInvoiceExpenseTransfer = $this->entityManager->createErpInvoiceExpense($erpInvoiceExpenseTransfer);
        $erpInvoiceExpenseTransfer = $this->erpInvoiceExpensePluginExecutor->executePostSavePlugins($erpInvoiceExpenseTransfer);

        return $erpInvoiceExpenseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceExpenseTransfer $erpInvoiceExpenseTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceExpenseTransfer
     */
    protected function executeUpdateTransaction(
        ErpInvoiceExpenseTransfer $erpInvoiceExpenseTransfer
    ): ErpInvoiceExpenseTransfer {
        $erpInvoiceExpenseTransfer = $this->erpInvoiceExpensePluginExecutor->executePreSavePlugins($erpInvoiceExpenseTransfer);
        $erpInvoiceExpenseTransfer = $this->entityManager->updateErpInvoiceExpense($erpInvoiceExpenseTransfer);
        $erpInvoiceExpenseTransfer = $this->erpInvoiceExpensePluginExecutor->executePostSavePlugins($erpInvoiceExpenseTransfer);

        return $erpInvoiceExpenseTransfer;
    }

    /**
     * @param int $idErpInvoiceExpense
     *
     * @return void
     */
    protected function executeDeleteTransaction(int $idErpInvoiceExpense): void
    {
        $this->entityManager->deleteErpInvoiceExpenseByIdErpInvoiceExpense($idErpInvoiceExpense);
    }
}
