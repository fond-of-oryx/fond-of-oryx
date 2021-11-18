<?php

namespace FondOfOryx\Zed\ErpInvoice\Business\Model\Writer;

use FondOfOryx\Zed\ErpInvoice\Business\PluginExecutor\ErpInvoiceAmountPluginExecutorInterface;
use FondOfOryx\Zed\ErpInvoice\Persistence\ErpInvoiceEntityManagerInterface;
use Generated\Shared\Transfer\ErpInvoiceAmountTransfer;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionTrait;

class ErpInvoiceAmountWriter implements ErpInvoiceAmountWriterInterface
{
    use TransactionTrait;

    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Persistence\ErpInvoiceEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Business\PluginExecutor\ErpInvoiceAmountPluginExecutorInterface
     */
    protected $erpInvoiceAmountPluginExecutor;

    /**
     * @param \FondOfOryx\Zed\ErpInvoice\Persistence\ErpInvoiceEntityManagerInterface $entityManager
     * @param \FondOfOryx\Zed\ErpInvoice\Business\PluginExecutor\ErpInvoiceAmountPluginExecutorInterface $erpInvoiceAmountPluginExecutor
     */
    public function __construct(
        ErpInvoiceEntityManagerInterface $entityManager,
        ErpInvoiceAmountPluginExecutorInterface $erpInvoiceAmountPluginExecutor
    ) {
        $this->entityManager = $entityManager;
        $this->erpInvoiceAmountPluginExecutor = $erpInvoiceAmountPluginExecutor;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceAmountTransfer $erpInvoiceAmountTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceAmountTransfer
     */
    public function create(ErpInvoiceAmountTransfer $erpInvoiceAmountTransfer): ErpInvoiceAmountTransfer
    {
        $self = $this;
        $erpInvoiceAmountTransfer = $this->getTransactionHandler()->handleTransaction(
            static function () use ($erpInvoiceAmountTransfer, $self) {
                return $self->executePersistTransaction($erpInvoiceAmountTransfer);
            },
        );

        return $erpInvoiceAmountTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceAmountTransfer $erpInvoiceAmountTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceAmountTransfer
     */
    public function update(ErpInvoiceAmountTransfer $erpInvoiceAmountTransfer): ErpInvoiceAmountTransfer
    {
        $self = $this;
        $erpInvoiceAmountTransfer = $this->getTransactionHandler()->handleTransaction(
            static function () use ($erpInvoiceAmountTransfer, $self) {
                return $self->executeUpdateTransaction($erpInvoiceAmountTransfer);
            },
        );

        return $erpInvoiceAmountTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceAmountTransfer $erpInvoiceAmountTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceAmountTransfer
     */
    protected function executePersistTransaction(
        ErpInvoiceAmountTransfer $erpInvoiceAmountTransfer
    ): ErpInvoiceAmountTransfer {
        $erpInvoiceAmountTransfer = $this->erpInvoiceAmountPluginExecutor->executePreSavePlugins($erpInvoiceAmountTransfer);
        $erpInvoiceAmountTransfer = $this->entityManager->createErpInvoiceAmount($erpInvoiceAmountTransfer);
        $erpInvoiceAmountTransfer = $this->erpInvoiceAmountPluginExecutor->executePostSavePlugins($erpInvoiceAmountTransfer);

        return $erpInvoiceAmountTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceAmountTransfer $erpInvoiceAmountTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceAmountTransfer
     */
    protected function executeUpdateTransaction(
        ErpInvoiceAmountTransfer $erpInvoiceAmountTransfer
    ): ErpInvoiceAmountTransfer {
        $erpInvoiceAmountTransfer = $this->erpInvoiceAmountPluginExecutor->executePreSavePlugins($erpInvoiceAmountTransfer);
        $erpInvoiceAmountTransfer = $this->entityManager->updateErpInvoiceAmount($erpInvoiceAmountTransfer);
        $erpInvoiceAmountTransfer = $this->erpInvoiceAmountPluginExecutor->executePostSavePlugins($erpInvoiceAmountTransfer);

        return $erpInvoiceAmountTransfer;
    }
}
