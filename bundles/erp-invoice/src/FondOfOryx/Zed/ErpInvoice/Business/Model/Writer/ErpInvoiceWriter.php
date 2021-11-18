<?php

namespace FondOfOryx\Zed\ErpInvoice\Business\Model\Writer;

use Exception;
use FondOfOryx\Zed\ErpInvoice\Business\PluginExecutor\ErpInvoicePluginExecutorInterface;
use FondOfOryx\Zed\ErpInvoice\Exception\ErpInvoiceAlreadyExistsException;
use FondOfOryx\Zed\ErpInvoice\Exception\ErpInvoiceNotExistsException;
use FondOfOryx\Zed\ErpInvoice\Persistence\ErpInvoiceEntityManagerInterface;
use FondOfOryx\Zed\ErpInvoice\Persistence\ErpInvoiceRepositoryInterface;
use Generated\Shared\Transfer\ErpInvoiceResponseTransfer;
use Generated\Shared\Transfer\ErpInvoiceTransfer;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionTrait;

class ErpInvoiceWriter implements ErpInvoiceWriterInterface
{
    use TransactionTrait;

    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Persistence\ErpInvoiceEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Persistence\ErpInvoiceRepositoryInterface
     */
    protected $repository;

    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Business\PluginExecutor\ErpInvoicePluginExecutorInterface
     */
    protected $erpInvoicePluginExecutor;

    /**
     * @param \FondOfOryx\Zed\ErpInvoice\Persistence\ErpInvoiceEntityManagerInterface $entityManager
     * @param \FondOfOryx\Zed\ErpInvoice\Persistence\ErpInvoiceRepositoryInterface $repository
     * @param \FondOfOryx\Zed\ErpInvoice\Business\PluginExecutor\ErpInvoicePluginExecutorInterface $erpInvoicePluginExecutor
     */
    public function __construct(
        ErpInvoiceEntityManagerInterface $entityManager,
        ErpInvoiceRepositoryInterface $repository,
        ErpInvoicePluginExecutorInterface $erpInvoicePluginExecutor
    ) {
        $this->entityManager = $entityManager;
        $this->repository = $repository;
        $this->erpInvoicePluginExecutor = $erpInvoicePluginExecutor;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceTransfer $erpInvoiceTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceResponseTransfer
     */
    public function create(ErpInvoiceTransfer $erpInvoiceTransfer): ErpInvoiceResponseTransfer
    {
        $self = $this;
        $responseTransfer = (new ErpInvoiceResponseTransfer())
            ->setErpInvoice($erpInvoiceTransfer)
            ->setIsSuccessful(true);
        try {
            $responseTransfer = $this->getTransactionHandler()->handleTransaction(
                static function () use ($responseTransfer, $self) {
                    return $self->executePersistTransaction($responseTransfer);
                },
            );
        } catch (Exception $exception) {
            $responseTransfer->setErpInvoice(null)
                ->setIsSuccessful(false)
                ->setMessage($exception->getMessage());
        }

        return $responseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceTransfer $erpInvoiceTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceResponseTransfer
     */
    public function update(ErpInvoiceTransfer $erpInvoiceTransfer): ErpInvoiceResponseTransfer
    {
        $self = $this;
        $responseTransfer = (new ErpInvoiceResponseTransfer())
            ->setErpInvoice($erpInvoiceTransfer)
            ->setIsSuccessful(true);
        try {
            $responseTransfer = $this->getTransactionHandler()->handleTransaction(
                static function () use ($responseTransfer, $self) {
                    return $self->executeUpdateTransaction($responseTransfer);
                },
            );
        } catch (Exception $exception) {
            $responseTransfer->setErpInvoice(null)
                ->setIsSuccessful(false)
                ->setMessage($exception->getMessage());
        }

        return $responseTransfer;
    }

    /**
     * @param int $idErpInvoice
     *
     * @return void
     */
    public function delete(int $idErpInvoice): void
    {
        $self = $this;
        $this->getTransactionHandler()->handleTransaction(
            static function () use ($idErpInvoice, $self) {
                $self->executeDeleteTransaction($idErpInvoice);
            },
        );
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceResponseTransfer $erpInvoiceResponseTransfer
     *
     * @throws \FondOfOryx\Zed\ErpInvoice\Exception\ErpInvoiceNotExistsException
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceResponseTransfer
     */
    protected function executeUpdateTransaction(
        ErpInvoiceResponseTransfer $erpInvoiceResponseTransfer
    ): ErpInvoiceResponseTransfer {
        $erpInvoiceTransfer = $erpInvoiceResponseTransfer->getErpInvoice();
        $existingEprInvoice = $this->repository->findErpInvoiceByExternalReference($erpInvoiceTransfer->getExternalReference());

        if ($existingEprInvoice === null) {
            throw new ErpInvoiceNotExistsException(sprintf('Erp Invoice with external reference "%s" not exists! Use CREATE for creating it!', $erpInvoiceTransfer->getExternalReference()));
        }

        $erpInvoiceTransfer = $this->erpInvoicePluginExecutor->executePreSavePlugins($erpInvoiceTransfer, $existingEprInvoice);
        $erpInvoiceTransfer = $this->entityManager->updateErpInvoice($erpInvoiceTransfer);
        $erpInvoiceTransfer = $this->erpInvoicePluginExecutor->executePostSavePlugins($erpInvoiceTransfer, $existingEprInvoice);

        return $erpInvoiceResponseTransfer->setErpInvoice($erpInvoiceTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceResponseTransfer $erpInvoiceResponseTransfer
     *
     * @throws \FondOfOryx\Zed\ErpInvoice\Exception\ErpInvoiceAlreadyExistsException
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceResponseTransfer
     */
    protected function executePersistTransaction(
        ErpInvoiceResponseTransfer $erpInvoiceResponseTransfer
    ): ErpInvoiceResponseTransfer {
        $erpInvoiceTransfer = $erpInvoiceResponseTransfer->getErpInvoice();
        $existingEprInvoice = $this->repository->findErpInvoiceByExternalReference($erpInvoiceTransfer->getExternalReference());

        if ($existingEprInvoice !== null) {
            throw new ErpInvoiceAlreadyExistsException(sprintf('Erp Invoice with external reference "%s" already exists! Use PATCH for updating it!', $existingEprInvoice->getExternalReference()));
        }

        $erpInvoiceTransfer = $this->erpInvoicePluginExecutor->executePreSavePlugins($erpInvoiceTransfer);
        $erpInvoiceTransfer = $this->entityManager->createErpInvoice($erpInvoiceTransfer);
        $erpInvoiceTransfer = $this->erpInvoicePluginExecutor->executePostSavePlugins($erpInvoiceTransfer);

        return $erpInvoiceResponseTransfer->setErpInvoice($erpInvoiceTransfer);
    }

    /**
     * @param int $idErpInvoice
     *
     * @return void
     */
    protected function executeDeleteTransaction(int $idErpInvoice): void
    {
        $this->entityManager->deleteErpInvoiceByIdErpInvoice($idErpInvoice);
    }
}
