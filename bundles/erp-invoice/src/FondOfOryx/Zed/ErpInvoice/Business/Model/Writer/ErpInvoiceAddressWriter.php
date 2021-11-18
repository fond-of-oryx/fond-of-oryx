<?php

namespace FondOfOryx\Zed\ErpInvoice\Business\Model\Writer;

use FondOfOryx\Zed\ErpInvoice\Business\PluginExecutor\ErpInvoiceAddressPluginExecutorInterface;
use FondOfOryx\Zed\ErpInvoice\Persistence\ErpInvoiceEntityManagerInterface;
use Generated\Shared\Transfer\ErpInvoiceAddressTransfer;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionTrait;

class ErpInvoiceAddressWriter implements ErpInvoiceAddressWriterInterface
{
    use TransactionTrait;

    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Persistence\ErpInvoiceEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Business\PluginExecutor\ErpInvoiceAddressPluginExecutorInterface
     */
    protected $erpInvoiceAddressPluginExecutor;

    /**
     * @param \FondOfOryx\Zed\ErpInvoice\Persistence\ErpInvoiceEntityManagerInterface $entityManager
     * @param \FondOfOryx\Zed\ErpInvoice\Business\PluginExecutor\ErpInvoiceAddressPluginExecutorInterface $erpInvoiceAddressPluginExecutor
     */
    public function __construct(
        ErpInvoiceEntityManagerInterface $entityManager,
        ErpInvoiceAddressPluginExecutorInterface $erpInvoiceAddressPluginExecutor
    ) {
        $this->entityManager = $entityManager;
        $this->erpInvoiceAddressPluginExecutor = $erpInvoiceAddressPluginExecutor;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceAddressTransfer $erpInvoiceAddressTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceAddressTransfer
     */
    public function create(ErpInvoiceAddressTransfer $erpInvoiceAddressTransfer): ErpInvoiceAddressTransfer
    {
        $self = $this;
        $erpInvoiceAddressTransfer = $this->getTransactionHandler()->handleTransaction(
            static function () use ($erpInvoiceAddressTransfer, $self) {
                return $self->executePersistTransaction($erpInvoiceAddressTransfer);
            },
        );

        return $erpInvoiceAddressTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceAddressTransfer $erpInvoiceAddressTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceAddressTransfer
     */
    public function update(ErpInvoiceAddressTransfer $erpInvoiceAddressTransfer): ErpInvoiceAddressTransfer
    {
        $self = $this;
        $erpInvoiceAddressTransfer = $this->getTransactionHandler()->handleTransaction(
            static function () use ($erpInvoiceAddressTransfer, $self) {
                return $self->executeUpdateTransaction($erpInvoiceAddressTransfer);
            },
        );

        return $erpInvoiceAddressTransfer;
    }

    /**
     * @param int $idErpInvoiceAddress
     *
     * @return void
     */
    public function delete(int $idErpInvoiceAddress): void
    {
        $self = $this;
        $this->getTransactionHandler()->handleTransaction(
            static function () use ($idErpInvoiceAddress, $self) {
                $self->executeDeleteTransaction($idErpInvoiceAddress);
            },
        );
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceAddressTransfer $erpInvoiceAddressTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceAddressTransfer
     */
    protected function executePersistTransaction(
        ErpInvoiceAddressTransfer $erpInvoiceAddressTransfer
    ): ErpInvoiceAddressTransfer {
        $erpInvoiceAddressTransfer = $this->erpInvoiceAddressPluginExecutor->executePreSavePlugins($erpInvoiceAddressTransfer);
        $erpInvoiceAddressTransfer = $this->entityManager->createErpInvoiceAddress($erpInvoiceAddressTransfer);
        $erpInvoiceAddressTransfer = $this->erpInvoiceAddressPluginExecutor->executePostSavePlugins($erpInvoiceAddressTransfer);

        return $erpInvoiceAddressTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceAddressTransfer $erpInvoiceAddressTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceAddressTransfer
     */
    protected function executeUpdateTransaction(
        ErpInvoiceAddressTransfer $erpInvoiceAddressTransfer
    ): ErpInvoiceAddressTransfer {
        $erpInvoiceAddressTransfer = $this->erpInvoiceAddressPluginExecutor->executePreSavePlugins($erpInvoiceAddressTransfer);
        $erpInvoiceAddressTransfer = $this->entityManager->updateErpInvoiceAddress($erpInvoiceAddressTransfer);
        $erpInvoiceAddressTransfer = $this->erpInvoiceAddressPluginExecutor->executePostSavePlugins($erpInvoiceAddressTransfer);

        return $erpInvoiceAddressTransfer;
    }

    /**
     * @param int $idErpInvoiceAddress
     *
     * @return void
     */
    protected function executeDeleteTransaction(int $idErpInvoiceAddress): void
    {
        $this->entityManager->deleteErpInvoiceAddressByIdErpInvoiceAddress($idErpInvoiceAddress);
    }
}
