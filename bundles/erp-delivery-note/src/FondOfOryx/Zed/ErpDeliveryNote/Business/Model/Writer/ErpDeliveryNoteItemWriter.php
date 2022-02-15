<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Writer;

use FondOfOryx\Zed\ErpDeliveryNote\Business\PluginExecutor\ErpDeliveryNoteItemPluginExecutorInterface;
use FondOfOryx\Zed\ErpDeliveryNote\Persistence\ErpDeliveryNoteEntityManagerInterface;
use Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionTrait;

class ErpDeliveryNoteItemWriter implements ErpDeliveryNoteItemWriterInterface
{
    use TransactionTrait;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Persistence\ErpDeliveryNoteEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Business\PluginExecutor\ErpDeliveryNoteItemPluginExecutorInterface
     */
    protected $erpDeliveryNoteItemPluginExecutor;

    /**
     * @param \FondOfOryx\Zed\ErpDeliveryNote\Persistence\ErpDeliveryNoteEntityManagerInterface $entityManager
     * @param \FondOfOryx\Zed\ErpDeliveryNote\Business\PluginExecutor\ErpDeliveryNoteItemPluginExecutorInterface $erpDeliveryNoteItemPluginExecutor
     */
    public function __construct(
        ErpDeliveryNoteEntityManagerInterface $entityManager,
        ErpDeliveryNoteItemPluginExecutorInterface $erpDeliveryNoteItemPluginExecutor
    ) {
        $this->entityManager = $entityManager;
        $this->erpDeliveryNoteItemPluginExecutor = $erpDeliveryNoteItemPluginExecutor;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer $erpDeliveryNoteItemTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer
     */
    public function create(ErpDeliveryNoteItemTransfer $erpDeliveryNoteItemTransfer): ErpDeliveryNoteItemTransfer
    {
        $self = $this;
        $erpDeliveryNoteItemTransfer = $this->getTransactionHandler()->handleTransaction(
            static function () use ($erpDeliveryNoteItemTransfer, $self) {
                return $self->executePersistTransaction($erpDeliveryNoteItemTransfer);
            },
        );

        return $erpDeliveryNoteItemTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer $erpDeliveryNoteItemTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer
     */
    public function update(ErpDeliveryNoteItemTransfer $erpDeliveryNoteItemTransfer): ErpDeliveryNoteItemTransfer
    {
        $erpDeliveryNoteItemTransfer
            ->requireIdErpDeliveryNoteItem()
            ->requireFkErpDeliveryNote();

        $self = $this;
        $erpDeliveryNoteItemTransfer = $this->getTransactionHandler()->handleTransaction(
            static function () use ($erpDeliveryNoteItemTransfer, $self) {
                return $self->executeUpdateTransaction($erpDeliveryNoteItemTransfer);
            },
        );

        return $erpDeliveryNoteItemTransfer;
    }

    /**
     * @param int $idErpDeliveryNoteItem
     *
     * @return void
     */
    public function delete(int $idErpDeliveryNoteItem): void
    {
        $self = $this;
        $this->getTransactionHandler()->handleTransaction(
            static function () use ($idErpDeliveryNoteItem, $self) {
                $self->executeDeleteTransaction($idErpDeliveryNoteItem);
            },
        );
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer $erpDeliveryNoteItemTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer
     */
    protected function executePersistTransaction(
        ErpDeliveryNoteItemTransfer $erpDeliveryNoteItemTransfer
    ): ErpDeliveryNoteItemTransfer {
        $erpDeliveryNoteItemTransfer = $this->erpDeliveryNoteItemPluginExecutor->executePreSavePlugins($erpDeliveryNoteItemTransfer);
        $erpDeliveryNoteItemTransfer = $this->entityManager->createErpDeliveryNoteItem($erpDeliveryNoteItemTransfer);
        $erpDeliveryNoteItemTransfer = $this->erpDeliveryNoteItemPluginExecutor->executePostSavePlugins($erpDeliveryNoteItemTransfer);

        return $erpDeliveryNoteItemTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer $erpDeliveryNoteItemTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer
     */
    protected function executeUpdateTransaction(
        ErpDeliveryNoteItemTransfer $erpDeliveryNoteItemTransfer
    ): ErpDeliveryNoteItemTransfer {
        $erpDeliveryNoteItemTransfer = $this->erpDeliveryNoteItemPluginExecutor->executePreSavePlugins($erpDeliveryNoteItemTransfer);
        $erpDeliveryNoteItemTransfer = $this->entityManager->updateErpDeliveryNoteItem($erpDeliveryNoteItemTransfer);
        $erpDeliveryNoteItemTransfer = $this->erpDeliveryNoteItemPluginExecutor->executePostSavePlugins($erpDeliveryNoteItemTransfer);

        return $erpDeliveryNoteItemTransfer;
    }

    /**
     * @param int $idErpDeliveryNoteItem
     *
     * @return void
     */
    protected function executeDeleteTransaction(int $idErpDeliveryNoteItem): void
    {
        $this->entityManager->deleteErpDeliveryNoteItemByIdErpDeliveryNoteItem($idErpDeliveryNoteItem);
    }
}
