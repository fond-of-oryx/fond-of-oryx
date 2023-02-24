<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Writer;

use Exception;
use FondOfOryx\Zed\ErpDeliveryNote\Business\PluginExecutor\ErpDeliveryNotePluginExecutorInterface;
use FondOfOryx\Zed\ErpDeliveryNote\Exception\ErpDeliveryNoteAlreadyExistsException;
use FondOfOryx\Zed\ErpDeliveryNote\Exception\ErpDeliveryNoteNotExistsException;
use FondOfOryx\Zed\ErpDeliveryNote\Persistence\ErpDeliveryNoteEntityManagerInterface;
use FondOfOryx\Zed\ErpDeliveryNote\Persistence\ErpDeliveryNoteRepositoryInterface;
use Generated\Shared\Transfer\ErpDeliveryNoteResponseTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteTransfer;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionTrait;
use function DeepCopy\deep_copy;

class ErpDeliveryNoteWriter implements ErpDeliveryNoteWriterInterface
{
    use TransactionTrait;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Persistence\ErpDeliveryNoteEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Persistence\ErpDeliveryNoteRepositoryInterface
     */
    protected $repository;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Business\PluginExecutor\ErpDeliveryNotePluginExecutorInterface
     */
    protected $erpDeliveryNotePluginExecutor;

    /**
     * @param \FondOfOryx\Zed\ErpDeliveryNote\Persistence\ErpDeliveryNoteEntityManagerInterface $entityManager
     * @param \FondOfOryx\Zed\ErpDeliveryNote\Persistence\ErpDeliveryNoteRepositoryInterface $repository
     * @param \FondOfOryx\Zed\ErpDeliveryNote\Business\PluginExecutor\ErpDeliveryNotePluginExecutorInterface $erpDeliveryNotePluginExecutor
     */
    public function __construct(
        ErpDeliveryNoteEntityManagerInterface $entityManager,
        ErpDeliveryNoteRepositoryInterface $repository,
        ErpDeliveryNotePluginExecutorInterface $erpDeliveryNotePluginExecutor
    ) {
        $this->entityManager = $entityManager;
        $this->repository = $repository;
        $this->erpDeliveryNotePluginExecutor = $erpDeliveryNotePluginExecutor;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteResponseTransfer
     */
    public function create(ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer): ErpDeliveryNoteResponseTransfer
    {
        $self = $this;
        $responseTransfer = (new ErpDeliveryNoteResponseTransfer())
            ->setErpDeliveryNote($erpDeliveryNoteTransfer)
            ->setIsSuccessful(true);
        try {
            $responseTransfer = $this->getTransactionHandler()->handleTransaction(
                static function () use ($responseTransfer, $self) {
                    return $self->executePersistTransaction($responseTransfer);
                },
            );
        } catch (Exception $exception) {
            $responseTransfer->setErpDeliveryNote(null)
                ->setIsSuccessful(false)
                ->setMessage($exception->getMessage());
        }

        return $responseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteResponseTransfer
     */
    public function update(ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer): ErpDeliveryNoteResponseTransfer
    {
        $self = $this;
        $responseTransfer = (new ErpDeliveryNoteResponseTransfer())
            ->setErpDeliveryNote($erpDeliveryNoteTransfer)
            ->setIsSuccessful(true);
        try {
            $responseTransfer = $this->getTransactionHandler()->handleTransaction(
                static function () use ($responseTransfer, $self) {
                    return $self->executeUpdateTransaction($responseTransfer);
                },
            );
        } catch (Exception $exception) {
            $responseTransfer->setErpDeliveryNote(null)
                ->setIsSuccessful(false)
                ->setMessage($exception->getMessage());
        }

        return $responseTransfer;
    }

    /**
     * @param int $idErpDeliveryNote
     *
     * @return void
     */
    public function delete(int $idErpDeliveryNote): void
    {
        $self = $this;
        $this->getTransactionHandler()->handleTransaction(
            static function () use ($idErpDeliveryNote, $self) {
                $self->executeDeleteTransaction($idErpDeliveryNote);
            },
        );
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteResponseTransfer $erpDeliveryNoteResponseTransfer
     *
     * @throws \FondOfOryx\Zed\ErpDeliveryNote\Exception\ErpDeliveryNoteNotExistsException
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteResponseTransfer
     */
    protected function executeUpdateTransaction(
        ErpDeliveryNoteResponseTransfer $erpDeliveryNoteResponseTransfer
    ): ErpDeliveryNoteResponseTransfer {
        $erpDeliveryNoteTransfer = $erpDeliveryNoteResponseTransfer->getErpDeliveryNote();
        $existingErpDeliveryNote = $this->repository->findErpDeliveryNoteByExternalReference($erpDeliveryNoteTransfer->getExternalReference());

        if ($existingErpDeliveryNote === null) {
            throw new ErpDeliveryNoteNotExistsException(sprintf('Erp DeliveryNote with external reference "%s" not exists! Use CREATE for creating it!', $erpDeliveryNoteTransfer->getExternalReference()));
        }

        $erpDeliveryNoteTransfer = $this->erpDeliveryNotePluginExecutor->executePreSavePlugins($erpDeliveryNoteTransfer, deep_copy($existingErpDeliveryNote));
        $erpDeliveryNoteTransfer = $this->entityManager->updateErpDeliveryNote($erpDeliveryNoteTransfer);
        $erpDeliveryNoteTransfer = $this->erpDeliveryNotePluginExecutor->executePostSavePlugins($erpDeliveryNoteTransfer, deep_copy($existingErpDeliveryNote));

        return $erpDeliveryNoteResponseTransfer->setErpDeliveryNote($erpDeliveryNoteTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteResponseTransfer $erpDeliveryNoteResponseTransfer
     *
     * @throws \FondOfOryx\Zed\ErpDeliveryNote\Exception\ErpDeliveryNoteAlreadyExistsException
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteResponseTransfer
     */
    protected function executePersistTransaction(
        ErpDeliveryNoteResponseTransfer $erpDeliveryNoteResponseTransfer
    ): ErpDeliveryNoteResponseTransfer {
        $erpDeliveryNoteTransfer = $erpDeliveryNoteResponseTransfer->getErpDeliveryNote();
        $existingErpDeliveryNote = $this->repository->findErpDeliveryNoteByExternalReference($erpDeliveryNoteTransfer->getExternalReference());

        if ($existingErpDeliveryNote !== null) {
            throw new ErpDeliveryNoteAlreadyExistsException(sprintf('Erp DeliveryNote with external reference "%s" already exists! Use PATCH for updating it!', $existingErpDeliveryNote->getExternalReference()));
        }

        $erpDeliveryNoteTransfer = $this->erpDeliveryNotePluginExecutor->executePreSavePlugins($erpDeliveryNoteTransfer);
        $erpDeliveryNoteTransfer = $this->entityManager->createErpDeliveryNote($erpDeliveryNoteTransfer);
        $erpDeliveryNoteTransfer = $this->erpDeliveryNotePluginExecutor->executePostSavePlugins($erpDeliveryNoteTransfer);

        return $erpDeliveryNoteResponseTransfer->setErpDeliveryNote($erpDeliveryNoteTransfer);
    }

    /**
     * @param int $idErpDeliveryNote
     *
     * @return void
     */
    protected function executeDeleteTransaction(int $idErpDeliveryNote): void
    {
        $this->entityManager->deleteErpDeliveryNoteByIdErpDeliveryNote($idErpDeliveryNote);
    }
}
