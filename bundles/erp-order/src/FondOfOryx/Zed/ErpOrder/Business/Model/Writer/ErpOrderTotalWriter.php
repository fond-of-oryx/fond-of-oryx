<?php

namespace FondOfOryx\Zed\ErpOrder\Business\Model\Writer;

use FondOfOryx\Zed\ErpOrder\Business\PluginExecutor\ErpOrderTotalPluginExecutorInterface;
use FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderEntityManagerInterface;
use Generated\Shared\Transfer\ErpOrderTotalTransfer;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionTrait;

class ErpOrderTotalWriter implements ErpOrderTotalWriterInterface
{
    use TransactionTrait;

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Business\PluginExecutor\ErpOrderTotalPluginExecutorInterface
     */
    protected $erpOrderTotalPluginExecutor;

    /**
     * @param \FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderEntityManagerInterface $entityManager
     * @param \FondOfOryx\Zed\ErpOrder\Business\PluginExecutor\ErpOrderTotalPluginExecutorInterface $erpOrderTotalPluginExecutor
     */
    public function __construct(
        ErpOrderEntityManagerInterface $entityManager,
        ErpOrderTotalPluginExecutorInterface $erpOrderTotalPluginExecutor
    ) {
        $this->entityManager = $entityManager;
        $this->erpOrderTotalPluginExecutor = $erpOrderTotalPluginExecutor;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderTotalTransfer $erpOrderTotalTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderTotalTransfer
     */
    public function create(ErpOrderTotalTransfer $erpOrderTotalTransfer): ErpOrderTotalTransfer
    {
        $self = $this;
        $erpOrderTotalTransfer = $this->getTransactionHandler()->handleTransaction(
            static function () use ($erpOrderTotalTransfer, $self) {
                return $self->executePersistTransaction($erpOrderTotalTransfer);
            },
        );

        return $erpOrderTotalTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderTotalTransfer $erpOrderTotalTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderTotalTransfer
     */
    public function update(ErpOrderTotalTransfer $erpOrderTotalTransfer): ErpOrderTotalTransfer
    {
        $self = $this;
        $erpOrderTotalTransfer = $this->getTransactionHandler()->handleTransaction(
            static function () use ($erpOrderTotalTransfer, $self) {
                return $self->executeUpdateTransaction($erpOrderTotalTransfer);
            },
        );

        return $erpOrderTotalTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderTotalTransfer $erpOrderTotalTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderTotalTransfer
     */
    protected function executePersistTransaction(
        ErpOrderTotalTransfer $erpOrderTotalTransfer
    ): ErpOrderTotalTransfer {
        $erpOrderTotalTransfer = $this->erpOrderTotalPluginExecutor->executePreSavePlugins($erpOrderTotalTransfer);
        $erpOrderTotalTransfer = $this->entityManager->createOldErpOrderTotal($erpOrderTotalTransfer);
        $erpOrderTotalTransfer = $this->erpOrderTotalPluginExecutor->executePostSavePlugins($erpOrderTotalTransfer);

        return $erpOrderTotalTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderTotalTransfer $erpOrderTotalTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderTotalTransfer
     */
    protected function executeUpdateTransaction(
        ErpOrderTotalTransfer $erpOrderTotalTransfer
    ): ErpOrderTotalTransfer {
        $erpOrderTotalTransfer = $this->erpOrderTotalPluginExecutor->executePreSavePlugins($erpOrderTotalTransfer);
        $erpOrderTotalTransfer = $this->entityManager->updateErpOrderTotal($erpOrderTotalTransfer);
        $erpOrderTotalTransfer = $this->erpOrderTotalPluginExecutor->executePostSavePlugins($erpOrderTotalTransfer);

        return $erpOrderTotalTransfer;
    }
}
