<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Writer;

use FondOfOryx\Zed\ErpDeliveryNote\Business\PluginExecutor\ErpDeliveryNoteAddressPluginExecutorInterface;
use FondOfOryx\Zed\ErpDeliveryNote\Persistence\ErpDeliveryNoteEntityManagerInterface;
use Generated\Shared\Transfer\ErpDeliveryNoteAddressTransfer;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionTrait;

class ErpDeliveryNoteAddressWriter implements ErpDeliveryNoteAddressWriterInterface
{
    use TransactionTrait;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Persistence\ErpDeliveryNoteEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Business\PluginExecutor\ErpDeliveryNoteAddressPluginExecutorInterface
     */
    protected $erpDeliveryNoteAddressPluginExecutor;

    /**
     * @param \FondOfOryx\Zed\ErpDeliveryNote\Persistence\ErpDeliveryNoteEntityManagerInterface $entityManager
     * @param \FondOfOryx\Zed\ErpDeliveryNote\Business\PluginExecutor\ErpDeliveryNoteAddressPluginExecutorInterface $erpDeliveryNoteAddressPluginExecutor
     */
    public function __construct(
        ErpDeliveryNoteEntityManagerInterface $entityManager,
        ErpDeliveryNoteAddressPluginExecutorInterface $erpDeliveryNoteAddressPluginExecutor
    ) {
        $this->entityManager = $entityManager;
        $this->erpDeliveryNoteAddressPluginExecutor = $erpDeliveryNoteAddressPluginExecutor;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteAddressTransfer $erpDeliveryNoteAddressTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteAddressTransfer
     */
    public function create(ErpDeliveryNoteAddressTransfer $erpDeliveryNoteAddressTransfer): ErpDeliveryNoteAddressTransfer
    {
        $self = $this;
        $erpDeliveryNoteAddressTransfer = $this->getTransactionHandler()->handleTransaction(
            static function () use ($erpDeliveryNoteAddressTransfer, $self) {
                return $self->executePersistTransaction($erpDeliveryNoteAddressTransfer);
            },
        );

        return $erpDeliveryNoteAddressTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteAddressTransfer $erpDeliveryNoteAddressTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteAddressTransfer
     */
    public function update(ErpDeliveryNoteAddressTransfer $erpDeliveryNoteAddressTransfer): ErpDeliveryNoteAddressTransfer
    {
        $self = $this;
        $erpDeliveryNoteAddressTransfer = $this->getTransactionHandler()->handleTransaction(
            static function () use ($erpDeliveryNoteAddressTransfer, $self) {
                return $self->executeUpdateTransaction($erpDeliveryNoteAddressTransfer);
            },
        );

        return $erpDeliveryNoteAddressTransfer;
    }

    /**
     * @param int $idErpDeliveryNoteAddress
     *
     * @return void
     */
    public function delete(int $idErpDeliveryNoteAddress): void
    {
        $self = $this;
        $this->getTransactionHandler()->handleTransaction(
            static function () use ($idErpDeliveryNoteAddress, $self) {
                $self->executeDeleteTransaction($idErpDeliveryNoteAddress);
            },
        );
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteAddressTransfer $erpDeliveryNoteAddressTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteAddressTransfer
     */
    protected function executePersistTransaction(
        ErpDeliveryNoteAddressTransfer $erpDeliveryNoteAddressTransfer
    ): ErpDeliveryNoteAddressTransfer {
        $erpDeliveryNoteAddressTransfer = $this->erpDeliveryNoteAddressPluginExecutor->executePreSavePlugins($erpDeliveryNoteAddressTransfer);
        $erpDeliveryNoteAddressTransfer = $this->entityManager->createErpDeliveryNoteAddress($erpDeliveryNoteAddressTransfer);
        $erpDeliveryNoteAddressTransfer = $this->erpDeliveryNoteAddressPluginExecutor->executePostSavePlugins($erpDeliveryNoteAddressTransfer);

        return $erpDeliveryNoteAddressTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteAddressTransfer $erpDeliveryNoteAddressTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteAddressTransfer
     */
    protected function executeUpdateTransaction(
        ErpDeliveryNoteAddressTransfer $erpDeliveryNoteAddressTransfer
    ): ErpDeliveryNoteAddressTransfer {
        $erpDeliveryNoteAddressTransfer = $this->erpDeliveryNoteAddressPluginExecutor->executePreSavePlugins($erpDeliveryNoteAddressTransfer);
        $erpDeliveryNoteAddressTransfer = $this->entityManager->updateErpDeliveryNoteAddress($erpDeliveryNoteAddressTransfer);
        $erpDeliveryNoteAddressTransfer = $this->erpDeliveryNoteAddressPluginExecutor->executePostSavePlugins($erpDeliveryNoteAddressTransfer);

        return $erpDeliveryNoteAddressTransfer;
    }

    /**
     * @param int $idErpDeliveryNoteAddress
     *
     * @return void
     */
    protected function executeDeleteTransaction(int $idErpDeliveryNoteAddress): void
    {
        $this->entityManager->deleteErpDeliveryNoteAddressByIdErpDeliveryNoteAddress($idErpDeliveryNoteAddress);
    }
}
