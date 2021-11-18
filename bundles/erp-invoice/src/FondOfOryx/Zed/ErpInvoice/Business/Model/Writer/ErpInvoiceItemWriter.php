<?php

namespace FondOfOryx\Zed\ErpInvoice\Business\Model\Writer;

use FondOfOryx\Zed\ErpInvoice\Business\PluginExecutor\ErpInvoiceItemPluginExecutorInterface;
use FondOfOryx\Zed\ErpInvoice\Persistence\ErpInvoiceEntityManagerInterface;
use Generated\Shared\Transfer\ErpInvoiceItemTransfer;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionTrait;

class ErpInvoiceItemWriter implements ErpInvoiceItemWriterInterface
{
    use TransactionTrait;

    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Persistence\ErpInvoiceEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Business\PluginExecutor\ErpInvoiceItemPluginExecutorInterface
     */
    protected $erpInvoiceItemPluginExecutor;

    /**
     * @param \FondOfOryx\Zed\ErpInvoice\Persistence\ErpInvoiceEntityManagerInterface $entityManager
     * @param \FondOfOryx\Zed\ErpInvoice\Business\PluginExecutor\ErpInvoiceItemPluginExecutorInterface $erpInvoiceItemPluginExecutor
     */
    public function __construct(
        ErpInvoiceEntityManagerInterface $entityManager,
        ErpInvoiceItemPluginExecutorInterface $erpInvoiceItemPluginExecutor
    ) {
        $this->entityManager = $entityManager;
        $this->erpInvoiceItemPluginExecutor = $erpInvoiceItemPluginExecutor;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceItemTransfer $erpInvoiceItemTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceItemTransfer
     */
    public function create(ErpInvoiceItemTransfer $erpInvoiceItemTransfer): ErpInvoiceItemTransfer
    {
        $self = $this;
        $erpInvoiceItemTransfer = $this->getTransactionHandler()->handleTransaction(
            static function () use ($erpInvoiceItemTransfer, $self) {
                return $self->executePersistTransaction($erpInvoiceItemTransfer);
            },
        );

        return $erpInvoiceItemTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceItemTransfer $erpInvoiceItemTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceItemTransfer
     */
    public function update(ErpInvoiceItemTransfer $erpInvoiceItemTransfer): ErpInvoiceItemTransfer
    {
        $erpInvoiceItemTransfer
            ->requireIdErpInvoiceItem()
            ->requireFkErpInvoice();

        $self = $this;
        $erpInvoiceItemTransfer = $this->getTransactionHandler()->handleTransaction(
            static function () use ($erpInvoiceItemTransfer, $self) {
                return $self->executeUpdateTransaction($erpInvoiceItemTransfer);
            },
        );

        return $erpInvoiceItemTransfer;
    }

    /**
     * @param int $idErpInvoiceItem
     *
     * @return void
     */
    public function delete(int $idErpInvoiceItem): void
    {
        $self = $this;
        $this->getTransactionHandler()->handleTransaction(
            static function () use ($idErpInvoiceItem, $self) {
                $self->executeDeleteTransaction($idErpInvoiceItem);
            },
        );
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceItemTransfer $erpInvoiceItemTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceItemTransfer
     */
    protected function executePersistTransaction(
        ErpInvoiceItemTransfer $erpInvoiceItemTransfer
    ): ErpInvoiceItemTransfer {
        $erpInvoiceItemTransfer = $this->erpInvoiceItemPluginExecutor->executePreSavePlugins($erpInvoiceItemTransfer);
        $erpInvoiceItemTransfer = $this->entityManager->createErpInvoiceItem($erpInvoiceItemTransfer);
        $erpInvoiceItemTransfer = $this->erpInvoiceItemPluginExecutor->executePostSavePlugins($erpInvoiceItemTransfer);

        return $erpInvoiceItemTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceItemTransfer $erpInvoiceItemTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceItemTransfer
     */
    protected function executeUpdateTransaction(
        ErpInvoiceItemTransfer $erpInvoiceItemTransfer
    ): ErpInvoiceItemTransfer {
        $erpInvoiceItemTransfer = $this->erpInvoiceItemPluginExecutor->executePreSavePlugins($erpInvoiceItemTransfer);
        $erpInvoiceItemTransfer = $this->entityManager->updateErpInvoiceItem($erpInvoiceItemTransfer);
        $erpInvoiceItemTransfer = $this->erpInvoiceItemPluginExecutor->executePostSavePlugins($erpInvoiceItemTransfer);

        return $erpInvoiceItemTransfer;
    }

    /**
     * @param int $idErpInvoiceItem
     *
     * @return void
     */
    protected function executeDeleteTransaction(int $idErpInvoiceItem): void
    {
        $this->entityManager->deleteErpInvoiceItemByIdErpInvoiceItem($idErpInvoiceItem);
    }
}
