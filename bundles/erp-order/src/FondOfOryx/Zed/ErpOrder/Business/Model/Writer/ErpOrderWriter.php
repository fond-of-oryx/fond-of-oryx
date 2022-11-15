<?php

namespace FondOfOryx\Zed\ErpOrder\Business\Model\Writer;

use Exception;
use FondOfOryx\Zed\ErpOrder\Business\PluginExecutor\ErpOrderPluginExecutorInterface;
use FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderEntityManagerInterface;
use Generated\Shared\Transfer\ErpOrderResponseTransfer;
use Generated\Shared\Transfer\ErpOrderTransfer;
use Psr\Log\LoggerInterface;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionTrait;
use Throwable;

class ErpOrderWriter implements ErpOrderWriterInterface
{
    use TransactionTrait;

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Business\PluginExecutor\ErpOrderPluginExecutorInterface
     */
    protected $erpOrderPluginExecutor;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * @param \FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderEntityManagerInterface $entityManager
     * @param \FondOfOryx\Zed\ErpOrder\Business\PluginExecutor\ErpOrderPluginExecutorInterface $erpOrderPluginExecutor
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        ErpOrderEntityManagerInterface $entityManager,
        ErpOrderPluginExecutorInterface $erpOrderPluginExecutor,
        LoggerInterface $logger
    ) {
        $this->entityManager = $entityManager;
        $this->erpOrderPluginExecutor = $erpOrderPluginExecutor;
        $this->logger = $logger;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderTransfer $erpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderResponseTransfer
     */
    public function create(ErpOrderTransfer $erpOrderTransfer): ErpOrderResponseTransfer
    {
        $self = $this;
        $responseTransfer = (new ErpOrderResponseTransfer())
            ->setErpOrder($erpOrderTransfer)
            ->setIsSuccessful(true);
        try {
            $responseTransfer = $this->getTransactionHandler()->handleTransaction(
                static function () use ($responseTransfer, $self) {
                    return $self->executePersistTransaction($responseTransfer);
                },
            );
        } catch (Throwable $exception) {
            $this->logger->error($exception->getMessage(), [
                'exception' => $exception->getMessage(),
                'trace' => $exception->getTraceAsString(),
                'data' => $erpOrderTransfer->serialize(),
            ]);

            $responseTransfer->setErpOrder(null)
                ->setIsSuccessful(false);
        }

        return $responseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderTransfer $erpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderResponseTransfer
     */
    public function update(ErpOrderTransfer $erpOrderTransfer): ErpOrderResponseTransfer
    {
        $self = $this;
        $responseTransfer = (new ErpOrderResponseTransfer())
            ->setErpOrder($erpOrderTransfer)
            ->setIsSuccessful(true);
        try {
            $responseTransfer = $this->getTransactionHandler()->handleTransaction(
                static function () use ($responseTransfer, $self) {
                    return $self->executeUpdateTransaction($responseTransfer);
                },
            );
        } catch (Exception $exception) {
            $this->logger->error($exception->getMessage(), [
                'exception' => $exception->getMessage(),
                'trace' => $exception->getTraceAsString(),
                'data' => $erpOrderTransfer->serialize(),
            ]);

            $responseTransfer->setErpOrder(null)
                ->setIsSuccessful(false);
        }

        return $responseTransfer;
    }

    /**
     * @param int $idErpOrder
     *
     * @throws \Throwable
     *
     * @return void
     */
    public function delete(int $idErpOrder): void
    {
        $self = $this;

        try {
            $this->getTransactionHandler()->handleTransaction(
                static function () use ($idErpOrder, $self) {
                    $self->executeDeleteTransaction($idErpOrder);
                },
            );
        } catch (Throwable $exception) {
            $this->logger->error($exception->getMessage(), [
                'exception' => $exception->getMessage(),
                'trace' => $exception->getTraceAsString(),
                'data' => $idErpOrder,
            ]);

            throw $exception;
        }
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderResponseTransfer $erpOrderResponseTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderResponseTransfer
     */
    protected function executeUpdateTransaction(
        ErpOrderResponseTransfer $erpOrderResponseTransfer
    ): ErpOrderResponseTransfer {
        $erpOrderTransfer = $erpOrderResponseTransfer->getErpOrder();
        $erpOrderTransfer = $this->erpOrderPluginExecutor->executePreSavePlugins($erpOrderTransfer);
        $erpOrderTransfer = $this->entityManager->updateErpOrder($erpOrderTransfer);
        $erpOrderTransfer = $this->erpOrderPluginExecutor->executePostSavePlugins($erpOrderTransfer);

        return $erpOrderResponseTransfer->setErpOrder($erpOrderTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderResponseTransfer $erpOrderResponseTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderResponseTransfer
     */
    protected function executePersistTransaction(
        ErpOrderResponseTransfer $erpOrderResponseTransfer
    ): ErpOrderResponseTransfer {
        $erpOrderTransfer = $erpOrderResponseTransfer->getErpOrder();
        $erpOrderTransfer = $this->erpOrderPluginExecutor->executePreSavePlugins($erpOrderTransfer);
        $erpOrderTransfer = $this->entityManager->createErpOrder($erpOrderTransfer);
        $erpOrderTransfer = $this->erpOrderPluginExecutor->executePostSavePlugins($erpOrderTransfer);

        return $erpOrderResponseTransfer->setErpOrder($erpOrderTransfer);
    }

    /**
     * @param int $idErpOrder
     *
     * @return void
     */
    protected function executeDeleteTransaction(int $idErpOrder): void
    {
        $this->entityManager->deleteErpOrderByIdErpOrder($idErpOrder);
    }
}
