<?php

namespace FondOfOryx\Zed\CreditMemo\Business\Model;

use ArrayObject;
use Exception;
use FondOfOryx\Zed\CreditMemo\Persistence\CreditMemoEntityManagerInterface;
use Generated\Shared\Transfer\CreditMemoErrorTransfer;
use Generated\Shared\Transfer\CreditMemoResponseTransfer;
use Generated\Shared\Transfer\CreditMemoTransfer;
use Psr\Log\LoggerInterface;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionTrait;

class CreditMemoWriter implements CreditMemoWriterInterface
{
    use TransactionTrait;

    /**
     * @var \FondOfOryx\Zed\CreditMemo\Persistence\CreditMemoEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var \FondOfOryx\Zed\CreditMemo\Business\Model\CreditMemoPluginExecutorInterface
     */
    protected $creditMemoPluginExecutor;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * @param \FondOfOryx\Zed\CreditMemo\Persistence\CreditMemoEntityManagerInterface $entityManager
     * @param \FondOfOryx\Zed\CreditMemo\Business\Model\CreditMemoPluginExecutorInterface $creditMemoPluginExecutor
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        CreditMemoEntityManagerInterface $entityManager,
        CreditMemoPluginExecutorInterface $creditMemoPluginExecutor,
        LoggerInterface $logger
    ) {
        $this->entityManager = $entityManager;
        $this->creditMemoPluginExecutor = $creditMemoPluginExecutor;
        $this->logger = $logger;
    }

    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Generated\Shared\Transfer\CreditMemoResponseTransfer
     */
    public function create(
        CreditMemoTransfer $creditMemoTransfer
    ): CreditMemoResponseTransfer {
        $creditMemoResponseTransfer = (new CreditMemoResponseTransfer())
            ->setIsSuccess(false)
            ->setCreditMemoTransfer(null);

        try {
            $creditMemoTransfer = $this->getTransactionHandler()->handleTransaction(
                function () use ($creditMemoTransfer) {
                    return $this->executeCreateTransaction($creditMemoTransfer);
                },
            );

            $creditMemoResponseTransfer->setIsSuccess(true)
                ->setCreditMemoTransfer($creditMemoTransfer);
        } catch (Exception $exception) {
            $this->logger->error($exception->getMessage(), $exception->getTrace());

            $errorTransferList = new ArrayObject();

            $errorTransferList->append((new CreditMemoErrorTransfer())->setMessage($exception->getMessage()));

            $creditMemoResponseTransfer->setErrors($errorTransferList);
        }

        return $creditMemoResponseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Generated\Shared\Transfer\CreditMemoResponseTransfer
     */
    public function update(
        CreditMemoTransfer $creditMemoTransfer
    ): CreditMemoResponseTransfer {
        $creditMemoResponseTransfer = (new CreditMemoResponseTransfer())
            ->setIsSuccess(false)
            ->setCreditMemoTransfer(null);

        try {
            $creditMemoTransfer = $this->getTransactionHandler()->handleTransaction(
                function () use ($creditMemoTransfer) {
                    return $this->executeUpdateTransaction($creditMemoTransfer);
                },
            );

            $creditMemoResponseTransfer->setIsSuccess(true)
                ->setCreditMemoTransfer($creditMemoTransfer);
        } catch (Exception $exception) {
            $this->logger->error($exception->getMessage(), $exception->getTrace());
            $errorTransferList = new ArrayObject();

            $errorTransferList->append((new CreditMemoErrorTransfer())->setMessage($exception->getMessage()));

            $creditMemoResponseTransfer->setErrors($errorTransferList);
        }

        return $creditMemoResponseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Generated\Shared\Transfer\CreditMemoTransfer
     */
    protected function executeCreateTransaction(
        CreditMemoTransfer $creditMemoTransfer
    ): CreditMemoTransfer {
        $creditMemoTransfer = $this->creditMemoPluginExecutor
            ->executePreSavePlugins($creditMemoTransfer);

        $creditMemoTransfer = $this->entityManager->createCreditMemo($creditMemoTransfer);

        return $this->creditMemoPluginExecutor
            ->executePostSavePlugins($creditMemoTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Generated\Shared\Transfer\CreditMemoTransfer
     */
    protected function executeUpdateTransaction(
        CreditMemoTransfer $creditMemoTransfer
    ): CreditMemoTransfer {
        return $this->entityManager->updateCreditMemo($creditMemoTransfer);
    }
}
