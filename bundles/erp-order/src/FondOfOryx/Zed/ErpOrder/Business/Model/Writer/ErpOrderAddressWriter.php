<?php

namespace FondOfOryx\Zed\ErpOrder\Business\Model\Writer;

use FondOfOryx\Zed\ErpOrder\Business\PluginExecutor\ErpOrderAddressPluginExecutorInterface;
use FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderEntityManagerInterface;
use Generated\Shared\Transfer\ErpOrderAddressTransfer;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionTrait;

class ErpOrderAddressWriter implements ErpOrderAddressWriterInterface
{
    use TransactionTrait;

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Business\PluginExecutor\ErpOrderAddressPluginExecutorInterface
     */
    protected $erpOrderAddressPluginExecutor;

    /**
     * @param \FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderEntityManagerInterface $entityManager
     * @param \FondOfOryx\Zed\ErpOrder\Business\PluginExecutor\ErpOrderAddressPluginExecutorInterface $erpOrderAddressPluginExecutor
     */
    public function __construct(
        ErpOrderEntityManagerInterface $entityManager,
        ErpOrderAddressPluginExecutorInterface $erpOrderAddressPluginExecutor
    ) {
        $this->entityManager = $entityManager;
        $this->erpOrderAddressPluginExecutor = $erpOrderAddressPluginExecutor;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderAddressTransfer $erpOrderAddressTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderAddressTransfer
     */
    public function create(ErpOrderAddressTransfer $erpOrderAddressTransfer): ErpOrderAddressTransfer
    {
        $self = $this;
        $erpOrderAddressTransfer = $this->getTransactionHandler()->handleTransaction(
            static function () use ($erpOrderAddressTransfer, $self) {
                return $self->executePersistTransaction($erpOrderAddressTransfer);
            }
        );

        return $erpOrderAddressTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderAddressTransfer $erpOrderAddressTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderAddressTransfer
     */
    public function update(ErpOrderAddressTransfer $erpOrderAddressTransfer): ErpOrderAddressTransfer
    {
        $self = $this;
        $erpOrderAddressTransfer = $this->getTransactionHandler()->handleTransaction(
            static function () use ($erpOrderAddressTransfer, $self) {
                return $self->executeUpdateTransaction($erpOrderAddressTransfer);
            }
        );

        return $erpOrderAddressTransfer;
    }

    /**
     * @param int $idErpOrderAddress
     *
     * @return void
     */
    public function delete(int $idErpOrderAddress): void
    {
        $self = $this;
        $this->getTransactionHandler()->handleTransaction(
            static function () use ($idErpOrderAddress, $self) {
                $self->executeDeleteTransaction($idErpOrderAddress);
            }
        );
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderAddressTransfer $erpOrderAddressTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderAddressTransfer
     */
    protected function executePersistTransaction(
        ErpOrderAddressTransfer $erpOrderAddressTransfer
    ): ErpOrderAddressTransfer {
        $erpOrderAddressTransfer = $this->erpOrderAddressPluginExecutor->executePreSavePlugins($erpOrderAddressTransfer);
        $erpOrderAddressTransfer = $this->entityManager->createErpOrderAddress($erpOrderAddressTransfer);
        $erpOrderAddressTransfer = $this->erpOrderAddressPluginExecutor->executePostSavePlugins($erpOrderAddressTransfer);

        return $erpOrderAddressTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderAddressTransfer $erpOrderAddressTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderAddressTransfer
     */
    protected function executeUpdateTransaction(
        ErpOrderAddressTransfer $erpOrderAddressTransfer
    ): ErpOrderAddressTransfer {
        $erpOrderAddressTransfer = $this->erpOrderAddressPluginExecutor->executePreSavePlugins($erpOrderAddressTransfer);
        $erpOrderAddressTransfer = $this->entityManager->updateErpOrderAddress($erpOrderAddressTransfer);
        $erpOrderAddressTransfer = $this->erpOrderAddressPluginExecutor->executePostSavePlugins($erpOrderAddressTransfer);

        return $erpOrderAddressTransfer;
    }

    /**
     * @param int $idErpOrderAddress
     *
     * @return void
     */
    protected function executeDeleteTransaction(int $idErpOrderAddress): void
    {
        $this->entityManager->deleteErpOrderAddressByIdErpOrderAddress($idErpOrderAddress);
    }
}
