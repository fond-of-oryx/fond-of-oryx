<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Writer;

use FondOfOryx\Zed\ErpDeliveryNote\Business\PluginExecutor\ErpDeliveryNoteTrackingPluginExecutorInterface;
use FondOfOryx\Zed\ErpDeliveryNote\Persistence\ErpDeliveryNoteEntityManagerInterface;
use Generated\Shared\Transfer\ErpDeliveryNoteTrackingTransfer;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionTrait;

class ErpDeliveryNoteTrackingWriter implements ErpDeliveryNoteTrackingWriterInterface
{
    use TransactionTrait;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Persistence\ErpDeliveryNoteEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Business\PluginExecutor\ErpDeliveryNoteTrackingPluginExecutorInterface
     */
    protected $erpDeliveryNoteTrackingPluginExecutor;

    /**
     * @param \FondOfOryx\Zed\ErpDeliveryNote\Persistence\ErpDeliveryNoteEntityManagerInterface $entityManager
     * @param \FondOfOryx\Zed\ErpDeliveryNote\Business\PluginExecutor\ErpDeliveryNoteTrackingPluginExecutorInterface $erpDeliveryNoteTrackingPluginExecutor
     */
    public function __construct(
        ErpDeliveryNoteEntityManagerInterface $entityManager,
        ErpDeliveryNoteTrackingPluginExecutorInterface $erpDeliveryNoteTrackingPluginExecutor
    ) {
        $this->entityManager = $entityManager;
        $this->erpDeliveryNoteTrackingPluginExecutor = $erpDeliveryNoteTrackingPluginExecutor;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTrackingTransfer $erpDeliveryNoteTrackingTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteTrackingTransfer
     */
    public function create(ErpDeliveryNoteTrackingTransfer $erpDeliveryNoteTrackingTransfer): ErpDeliveryNoteTrackingTransfer
    {
        $self = $this;
        $erpDeliveryNoteTrackingTransfer = $this->getTransactionHandler()->handleTransaction(
            static function () use ($erpDeliveryNoteTrackingTransfer, $self) {
                return $self->executePersistTransaction($erpDeliveryNoteTrackingTransfer);
            },
        );

        return $erpDeliveryNoteTrackingTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTrackingTransfer $erpDeliveryNoteTrackingTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteTrackingTransfer
     */
    public function update(ErpDeliveryNoteTrackingTransfer $erpDeliveryNoteTrackingTransfer): ErpDeliveryNoteTrackingTransfer
    {
        $erpDeliveryNoteTrackingTransfer
            ->requireIdErpDeliveryNoteTracking()
            ->requireFkErpDeliveryNote();

        $self = $this;
        $erpDeliveryNoteTrackingTransfer = $this->getTransactionHandler()->handleTransaction(
            static function () use ($erpDeliveryNoteTrackingTransfer, $self) {
                return $self->executeUpdateTransaction($erpDeliveryNoteTrackingTransfer);
            },
        );

        return $erpDeliveryNoteTrackingTransfer;
    }

    /**
     * @param int $idErpDeliveryNoteTracking
     *
     * @return void
     */
    public function delete(int $idErpDeliveryNoteTracking): void
    {
        $self = $this;
        $this->getTransactionHandler()->handleTransaction(
            static function () use ($idErpDeliveryNoteTracking, $self) {
                $self->executeDeleteTransaction($idErpDeliveryNoteTracking);
            },
        );
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTrackingTransfer $erpDeliveryNoteTrackingTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteTrackingTransfer
     */
    protected function executePersistTransaction(
        ErpDeliveryNoteTrackingTransfer $erpDeliveryNoteTrackingTransfer
    ): ErpDeliveryNoteTrackingTransfer {
        $erpDeliveryNoteTrackingTransfer = $this->erpDeliveryNoteTrackingPluginExecutor->executePreSavePlugins($erpDeliveryNoteTrackingTransfer);
        $erpDeliveryNoteTrackingTransfer = $this->entityManager->createErpDeliveryNoteTracking($erpDeliveryNoteTrackingTransfer);
        $erpDeliveryNoteTrackingTransfer = $this->erpDeliveryNoteTrackingPluginExecutor->executePostSavePlugins($erpDeliveryNoteTrackingTransfer);

        return $erpDeliveryNoteTrackingTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTrackingTransfer $erpDeliveryNoteTrackingTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteTrackingTransfer
     */
    protected function executeUpdateTransaction(
        ErpDeliveryNoteTrackingTransfer $erpDeliveryNoteTrackingTransfer
    ): ErpDeliveryNoteTrackingTransfer {
        $erpDeliveryNoteTrackingTransfer = $this->erpDeliveryNoteTrackingPluginExecutor->executePreSavePlugins($erpDeliveryNoteTrackingTransfer);
        $erpDeliveryNoteTrackingTransfer = $this->entityManager->updateErpDeliveryNoteTracking($erpDeliveryNoteTrackingTransfer);
        $erpDeliveryNoteTrackingTransfer = $this->erpDeliveryNoteTrackingPluginExecutor->executePostSavePlugins($erpDeliveryNoteTrackingTransfer);

        return $erpDeliveryNoteTrackingTransfer;
    }

    /**
     * @param int $idErpDeliveryNoteTracking
     *
     * @return void
     */
    protected function executeDeleteTransaction(int $idErpDeliveryNoteTracking): void
    {
        $this->entityManager->deleteErpDeliveryNoteTrackingByIdErpDeliveryNoteTracking($idErpDeliveryNoteTracking);
    }
}
