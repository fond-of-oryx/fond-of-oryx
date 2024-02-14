<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUser\Business\Manager;

use FondOfOryx\Shared\RepresentativeCompanyUser\RepresentativeCompanyUserConstants;
use FondOfOryx\Zed\RepresentativeCompanyUser\Dependency\Facade\RepresentativeCompanyUserToEventFacadeInterface;
use FondOfOryx\Zed\RepresentativeCompanyUser\Persistence\RepresentativeCompanyUserEntityManagerInterface;
use FondOfOryx\Zed\RepresentativeCompanyUser\Persistence\RepresentativeCompanyUserRepositoryInterface;
use Generated\Shared\Transfer\RepresentativeCompanyUserCollectionTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTransfer;
use Orm\Zed\RepresentativeCompanyUser\Persistence\Map\FooRepresentativeCompanyUserTableMap;

class RepresentationManager implements RepresentationManagerInterface
{
    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUser\Persistence\RepresentativeCompanyUserEntityManagerInterface
     */
    protected RepresentativeCompanyUserEntityManagerInterface $entityManager;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUser\Persistence\RepresentativeCompanyUserRepositoryInterface
     */
    protected RepresentativeCompanyUserRepositoryInterface $repository;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUser\Dependency\Facade\RepresentativeCompanyUserToEventFacadeInterface
     */
    protected $eventFacade;

    /**
     * @param \FondOfOryx\Zed\RepresentativeCompanyUser\Persistence\RepresentativeCompanyUserEntityManagerInterface $entityManager
     * @param \FondOfOryx\Zed\RepresentativeCompanyUser\Persistence\RepresentativeCompanyUserRepositoryInterface $repository
     * @param \FondOfOryx\Zed\RepresentativeCompanyUser\Dependency\Facade\RepresentativeCompanyUserToEventFacadeInterface $eventFacade
     */
    public function __construct(
        RepresentativeCompanyUserEntityManagerInterface $entityManager,
        RepresentativeCompanyUserRepositoryInterface $repository,
        RepresentativeCompanyUserToEventFacadeInterface $eventFacade
    ) {
        $this->entityManager = $entityManager;
        $this->repository = $repository;
        $this->eventFacade = $eventFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer $filterTransfer
     *
     * @return void
     */
    public function checkForExpiration(RepresentativeCompanyUserFilterTransfer $filterTransfer): void
    {
        $filterTransfer->setStates([FooRepresentativeCompanyUserTableMap::COL_STATE_ACTIVE]);
        $expiredCollection = $this->repository->findExpiredRepresentativeCompanyUser($filterTransfer);

        if ($expiredCollection->getRepresentations()->count() === 0) {
            return;
        }

        $expiredCollection = $this->checkForActiveOwnerChange($filterTransfer, $expiredCollection);
        foreach ($this->setAllInProcess($expiredCollection)->getRepresentations() as $representationTransfer) {
            $this->eventFacade->trigger(
                RepresentativeCompanyUserConstants::REPRESENTATIVE_COMPANY_USER_MARK_FOR_EXPIRE,
                $representationTransfer,
            );
        }
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer $filterTransfer
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserCollectionTransfer $expiredCollection
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserCollectionTransfer
     */
    protected function checkForActiveOwnerChange(
        RepresentativeCompanyUserFilterTransfer $filterTransfer,
        RepresentativeCompanyUserCollectionTransfer $expiredCollection
    ) {
        $filterTransfer->setValidTimeRange(true);
        $collection = $this->repository->findRepresentationsShouldBeActiveByRange($filterTransfer);
        $expiredRepresentations = $expiredCollection->getRepresentations();

        foreach ($collection->getRepresentations() as $representation) {
            $fkRepresentative = $representation->getFkRepresentative();
            $fkDistributor = $representation->getFkDistributor();
            foreach ($expiredRepresentations as $expiredRepresentation) {
                if ($expiredRepresentation->getChangeCompanyUserOwnershipTo() !== null) {
                    continue;
                }

                if (
                    $expiredRepresentation->getFkDistributor() === $fkDistributor
                    && $expiredRepresentation->getFkRepresentative() === $fkRepresentative
                ) {
                    $expiredRepresentation->setChangeCompanyUserOwnershipTo($representation);
                }
            }
        }

        return $expiredCollection->setRepresentations($expiredRepresentations);
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer $filterTransfer
     *
     * @return void
     */
    public function checkForRevocation(RepresentativeCompanyUserFilterTransfer $filterTransfer): void
    {
        $revokedCollection = $this->repository->findRepresentativeCompanyUserByState(FooRepresentativeCompanyUserTableMap::COL_STATE_REVOKED);
        foreach ($this->setAllInProcess($revokedCollection)->getRepresentations() as $representationTransfer) {
            $this->eventFacade->trigger(
                RepresentativeCompanyUserConstants::REPRESENTATIVE_COMPANY_USER_MARK_FOR_REVOCATION,
                $representationTransfer,
            );
        }
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer $filterTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserCollectionTransfer
     */
    public function getRepresentativeCompanyUser(RepresentativeCompanyUserFilterTransfer $filterTransfer): RepresentativeCompanyUserCollectionTransfer
    {
        return $this->repository->getRepresentativeCompanyUser($filterTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer $filterTransfer
     *
     * @return void
     */
    public function checkForActivation(RepresentativeCompanyUserFilterTransfer $filterTransfer): void
    {
        $filterTransfer->setStates([FooRepresentativeCompanyUserTableMap::COL_STATE_NEW]);
        $filterTransfer->setValidTimeRange(true);
        foreach ($this->entityManager->findAndFlagInProcessNewRepresentativeCompanyUser($filterTransfer)->getRepresentations() as $representationTransfer) {
            $this->eventFacade->trigger(
                RepresentativeCompanyUserConstants::REPRESENTATIVE_COMPANY_USER_MARK_FOR_CREATE_COMPANY_USER,
                $representationTransfer,
            );
        }
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer
     */
    public function addRepresentation(RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer): RepresentativeCompanyUserTransfer
    {
        return $this->entityManager->createRepresentativeCompanyUser($representativeCompanyUserTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer
     */
    public function updateRepresentation(RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer): RepresentativeCompanyUserTransfer
    {
        $representativeCompanyUserTransfer->requireUuid();

        return $this->entityManager->updateRepresentativeCompanyUser($representativeCompanyUserTransfer);
    }

    /**
     * @param string $uuid
     * @param string $state
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer
     */
    public function flagState(string $uuid, string $state): RepresentativeCompanyUserTransfer
    {
        return $this->entityManager->flagState($uuid, $state);
    }

    /**
     * @param string $uuid
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer
     */
    public function findByUuid(string $uuid): RepresentativeCompanyUserTransfer
    {
        return $this->repository->findRepresentationByUuid($uuid);
    }

    /**
     * @param string $uuid
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer
     */
    public function deleteRepresentativeCompanyUser(string $uuid): RepresentativeCompanyUserTransfer
    {
        return $this->flagState($uuid, FooRepresentativeCompanyUserTableMap::COL_STATE_REVOKED);
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserCollectionTransfer $representativeCompanyUserCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserCollectionTransfer
     */
    public function setAllInProcess(
        RepresentativeCompanyUserCollectionTransfer $representativeCompanyUserCollectionTransfer
    ): RepresentativeCompanyUserCollectionTransfer {
        $collection = new RepresentativeCompanyUserCollectionTransfer();
        foreach ($representativeCompanyUserCollectionTransfer->getRepresentations() as $representation) {
            $changeOwnership = $representation->getChangeCompanyUserOwnershipTo();
            $representation = $this->flagState($representation->getUuid(), FooRepresentativeCompanyUserTableMap::COL_STATE_PROCESS);
            $representation->setChangeCompanyUserOwnershipTo($changeOwnership);
            $collection->addRepresentation($representation);
        }

        return $collection;
    }
}
