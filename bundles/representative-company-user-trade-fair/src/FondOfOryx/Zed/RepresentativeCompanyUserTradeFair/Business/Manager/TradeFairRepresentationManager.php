<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Business\Manager;
use Exception;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Dependency\Facade\RepresentativeCompanyUserTradeFairToRepresentativeCompanyUserInterface;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Dependency\Service\RepresentativeCompanyUserTradeFairToUtilUuidGeneratorServiceInterface;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Persistence\RepresentativeCompanyUserTradeFairEntityManagerInterface;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Persistence\RepresentativeCompanyUserTradeFairRepositoryInterface;
use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairCollectionTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairFilterTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTransfer;
use Orm\Zed\RepresentativeCompanyUser\Persistence\Map\FooRepresentativeCompanyUserTableMap;
use Psr\Log\LoggerInterface;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface;
use Throwable;

class TradeFairRepresentationManager implements TradeFairRepresentationManagerInterface
{
    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Persistence\RepresentativeCompanyUserTradeFairEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Persistence\RepresentativeCompanyUserTradeFairRepositoryInterface
     */
    protected $repository;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Dependency\Facade\RepresentativeCompanyUserTradeFairToRepresentativeCompanyUserInterface
     */
    protected $representativeCompanyUserFacade;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Dependency\Service\RepresentativeCompanyUserTradeFairToUtilUuidGeneratorServiceInterface
     */
    protected $uuidGenerator;

    /**
     * @var \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface
     */
    protected $transactionHandler;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * @param \FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Persistence\RepresentativeCompanyUserTradeFairEntityManagerInterface $entityManager
     * @param \FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Persistence\RepresentativeCompanyUserTradeFairRepositoryInterface $repository
     * @param \FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Dependency\Facade\RepresentativeCompanyUserTradeFairToRepresentativeCompanyUserInterface $representativeCompanyUserFacade
     * @param \FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Dependency\Service\RepresentativeCompanyUserTradeFairToUtilUuidGeneratorServiceInterface $uuidGenerator
     * @param \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface $transactionHandler
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        RepresentativeCompanyUserTradeFairEntityManagerInterface $entityManager,
        RepresentativeCompanyUserTradeFairRepositoryInterface $repository,
        RepresentativeCompanyUserTradeFairToRepresentativeCompanyUserInterface $representativeCompanyUserFacade,
        RepresentativeCompanyUserTradeFairToUtilUuidGeneratorServiceInterface $uuidGenerator,
        TransactionHandlerInterface $transactionHandler,
        LoggerInterface $logger,
    ) {
        $this->entityManager = $entityManager;
        $this->repository = $repository;
        $this->representativeCompanyUserFacade = $representativeCompanyUserFacade;
        $this->uuidGenerator = $uuidGenerator;
        $this->transactionHandler = $transactionHandler;
        $this->logger = $logger;
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairFilterTransfer $filterTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairCollectionTransfer
     */
    public function get(RepresentativeCompanyUserTradeFairFilterTransfer $filterTransfer): RepresentativeCompanyUserTradeFairCollectionTransfer
    {
        return $this->repository->getRepresentativeCompanyUserTradeFair($filterTransfer);
    }

    /**
     * @param RepresentativeCompanyUserTradeFairTransfer $representativeCompanyUserTradeFairTransfer
     * @return RepresentativeCompanyUserTradeFairTransfer
     * @throws Throwable
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function create(RepresentativeCompanyUserTradeFairTransfer $representativeCompanyUserTradeFairTransfer): RepresentativeCompanyUserTradeFairTransfer
    {
        $self = $this;
        $uuid = $this->uuidGenerator->generateUuid5FromObjectId($this->generateObjectId($representativeCompanyUserTradeFairTransfer));
        $representativeCompanyUserTradeFairTransfer->setUuid($uuid);

        try {
            return $this->transactionHandler->handleTransaction(
                static function () use ($representativeCompanyUserTradeFairTransfer, $self) {
                    $toRepresent = $self->repository->resolveDistributorFksToRepresent($representativeCompanyUserTradeFairTransfer->getFkDistributor());
                    $representativeCompanyUserTradeFairTransfer->setActive(true);
                    $representativeCompanyUserTradeFairTransfer = $self->entityManager->createRepresentativeCompanyUserTradeFair($representativeCompanyUserTradeFairTransfer);

                    $representativeCompanyUserTransfer = $self->createRepresentativeCompanyUserTransfer($representativeCompanyUserTradeFairTransfer);

                    $done = [];
                    foreach ($toRepresent as $fkDistributorToRepresentate){
                        if (in_array($fkDistributorToRepresentate, $done, true)){
                            continue;
                        }
                        $representativeCompanyUserTransfer->setFkDistributor($fkDistributorToRepresentate);
                        $self->representativeCompanyUserFacade->createRepresentativeCompanyUser($representativeCompanyUserTransfer);
                        $done[] = $fkDistributorToRepresentate;
                    }

                    return $representativeCompanyUserTradeFairTransfer;
                },
            );
        } catch (Throwable $throwable) {
            $this->logger->error($throwable->getMessage(), $throwable->getTrace());
            throw $throwable;
        }
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer $representativeCompanyUserTradeFairTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer
     */
    public function update(RepresentativeCompanyUserTradeFairTransfer $representativeCompanyUserTradeFairTransfer): RepresentativeCompanyUserTradeFairTransfer
    {
        $self = $this;
        $representativeCompanyUserTradeFairTransfer->requireUuid();

        try {
            return $this->transactionHandler->handleTransaction(
                static function () use ($representativeCompanyUserTradeFairTransfer, $self) {
                    $representativeCompanyUserTradeFairTransferUpdate = $self->repository->findTradeFairByUuid($representativeCompanyUserTradeFairTransfer->getUuid());

                    if ($representativeCompanyUserTradeFairTransferUpdate->getFkDistributor() !== $representativeCompanyUserTradeFairTransfer->getFkDistributor()){
                        throw new Exception('Please use delete endpoint fist and then create new trade fair entry!');
                    }

                    $representativeCompanyUserTradeFairTransferUpdate->fromArray($representativeCompanyUserTradeFairTransfer->modifiedToArray());

                    $fkDistributorIds = [];
                    foreach ($representativeCompanyUserTradeFairTransferUpdate->getRepresentativeCompanyUser() as $repCompanyUser){
                        $repCompanyUser
                            ->setFkRepresentative($representativeCompanyUserTradeFairTransferUpdate->getFkDistributor())
                            ->setFkOriginator($representativeCompanyUserTradeFairTransferUpdate->getFkOriginator())
                            ->setState(FooRepresentativeCompanyUserTableMap::COL_STATE_NEW)
                            ->setStartAt($representativeCompanyUserTradeFairTransferUpdate->getStartAt())
                            ->setEndAt($representativeCompanyUserTradeFairTransferUpdate->getEndAt());

                        $self->representativeCompanyUserFacade->updateRepresentativeCompanyUser($repCompanyUser);
                        $fkDistributorIds[] = $repCompanyUser->getFkDistributor();
                    }

                    $createNew = $self->repository->resolveDistributorFksToRepresent($representativeCompanyUserTradeFairTransferUpdate->getFkDistributor());
                    foreach ($createNew as $fkCustomer){
                        if (in_array($fkCustomer, $fkDistributorIds, true)){
                            continue;
                        }

                        $transfer = $self->createRepresentativeCompanyUserTransfer($representativeCompanyUserTradeFairTransferUpdate);
                        $transfer->setFkDistributor($fkCustomer);
                        $self->representativeCompanyUserFacade->createRepresentativeCompanyUser($transfer);
                    }
                    $representativeCompanyUserTradeFairTransfer->setActive(true);
                    return $self->entityManager->updateRepresentativeCompanyUserTradeFair($representativeCompanyUserTradeFairTransfer);
                },
            );
        } catch (Throwable $throwable) {
            $this->logger->error($throwable->getMessage(), $throwable->getTrace());
            throw $throwable;
        }
    }

    /**
     * @param string $uuid
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer
     */
    public function findByUuid(string $uuid): RepresentativeCompanyUserTradeFairTransfer
    {
        return $this->repository->findRepresentativeCompanyUserTradeFairByUuid($uuid);
    }

    /**
     * @param string $uuid
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer
     */
    public function delete(string $uuid): RepresentativeCompanyUserTradeFairTransfer
    {
        $self = $this;

        try {
            return $this->transactionHandler->handleTransaction(
                static function () use ($uuid, $self) {
                    return $self->entityManager->deactivate($uuid);
                },
            );
        } catch (Throwable $throwable) {
            $this->logger->error($throwable->getMessage(), $throwable->getTrace());
            throw $throwable;
        }
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer $representativeCompanyUserTradeFairTransfer
     *
     * @return string
     */
    protected function generateObjectId(RepresentativeCompanyUserTradeFairTransfer $representativeCompanyUserTradeFairTransfer): string
    {
        return sprintf('%s-%s-%s-%s-%s', $representativeCompanyUserTradeFairTransfer->getName(), $representativeCompanyUserTradeFairTransfer->getFkDistributor(), $representativeCompanyUserTradeFairTransfer->getFkOriginator(), $representativeCompanyUserTradeFairTransfer->getStartAt(), $representativeCompanyUserTradeFairTransfer->getEndAt());
    }

    /**
     * @param RepresentativeCompanyUserTradeFairTransfer $representativeCompanyUserTradeFairTransfer
     * @return RepresentativeCompanyUserTransfer
     */
    protected function createRepresentativeCompanyUserTransfer(RepresentativeCompanyUserTradeFairTransfer $representativeCompanyUserTradeFairTransfer): RepresentativeCompanyUserTransfer
    {
        return (new RepresentativeCompanyUserTransfer())
            ->setFkRepresentativeCompanyUserTradeFair($representativeCompanyUserTradeFairTransfer->getIdRepresentativeCompanyUserTradeFair())
            ->setFkRepresentative($representativeCompanyUserTradeFairTransfer->getFkDistributor())
            ->setState(FooRepresentativeCompanyUserTableMap::COL_STATE_NEW)
            ->setFkOriginator($representativeCompanyUserTradeFairTransfer->getFkOriginator())
            ->setStartAt($representativeCompanyUserTradeFairTransfer->getStartAt())
            ->setEndAt($representativeCompanyUserTradeFairTransfer->getEndAt());
    }
}
