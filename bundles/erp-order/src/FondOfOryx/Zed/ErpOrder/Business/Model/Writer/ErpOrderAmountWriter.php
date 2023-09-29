<?php

namespace FondOfOryx\Zed\ErpOrder\Business\Model\Writer;

use FondOfOryx\Zed\ErpOrder\Business\PluginExecutor\ErpOrderAmountPluginExecutorInterface;
use FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderEntityManagerInterface;
use Generated\Shared\Transfer\ErpOrderAmountTransfer;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionTrait;

class ErpOrderAmountWriter implements ErpOrderAmountWriterInterface
{
    use TransactionTrait;

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Business\PluginExecutor\ErpOrderAmountPluginExecutorInterface
     */
    protected $erpOrderAmountPluginExecutor;

    /**
     * @param \FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderEntityManagerInterface $entityManager
     * @param \FondOfOryx\Zed\ErpOrder\Business\PluginExecutor\ErpOrderAmountPluginExecutorInterface $erpOrderAmountPluginExecutor
     */
    public function __construct(
        ErpOrderEntityManagerInterface $entityManager,
        ErpOrderAmountPluginExecutorInterface $erpOrderAmountPluginExecutor
    ) {
        $this->entityManager = $entityManager;
        $this->erpOrderAmountPluginExecutor = $erpOrderAmountPluginExecutor;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderAmountTransfer $erpOrderAmountTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderAmountTransfer
     */
    public function create(ErpOrderAmountTransfer $erpOrderAmountTransfer): ErpOrderAmountTransfer
    {
        $self = $this;
        $erpOrderAmountTransfer = $this->getTransactionHandler()->handleTransaction(
            static function () use ($erpOrderAmountTransfer, $self) {
                return $self->executePersistTransaction($erpOrderAmountTransfer);
            },
        );

        return $erpOrderAmountTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderAmountTransfer $erpOrderAmountTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderAmountTransfer
     */
    public function update(ErpOrderAmountTransfer $erpOrderAmountTransfer): ErpOrderAmountTransfer
    {
        $self = $this;
        $erpOrderAmountTransfer = $this->getTransactionHandler()->handleTransaction(
            static function () use ($erpOrderAmountTransfer, $self) {
                return $self->executeUpdateTransaction($erpOrderAmountTransfer);
            },
        );

        return $erpOrderAmountTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderAmountTransfer $erpOrderAmountTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderAmountTransfer
     */
    protected function executePersistTransaction(
        ErpOrderAmountTransfer $erpOrderAmountTransfer
    ): ErpOrderAmountTransfer {
        $erpOrderAmountTransfer = $this->erpOrderAmountPluginExecutor->executePreSavePlugins($erpOrderAmountTransfer);
        $erpOrderAmountTransfer = $this->entityManager->createErpOrderAmount($erpOrderAmountTransfer);
        $erpOrderAmountTransfer = $this->erpOrderAmountPluginExecutor->executePostSavePlugins($erpOrderAmountTransfer);

        return $erpOrderAmountTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderAmountTransfer $erpOrderAmountTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderAmountTransfer
     */
    protected function executeUpdateTransaction(
        ErpOrderAmountTransfer $erpOrderAmountTransfer
    ): ErpOrderAmountTransfer {
        $erpOrderAmountTransfer = $this->erpOrderAmountPluginExecutor->executePreSavePlugins($erpOrderAmountTransfer);
        $erpOrderAmountTransfer = $this->entityManager->updateErpOrderAmount($erpOrderAmountTransfer);
        $erpOrderAmountTransfer = $this->erpOrderAmountPluginExecutor->executePostSavePlugins($erpOrderAmountTransfer);

        return $erpOrderAmountTransfer;
    }
}
