<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUser\Business\Manager;

use FondOfOryx\Shared\RepresentativeCompanyUser\RepresentativeCompanyUserConstants;
use FondOfOryx\Zed\RepresentativeCompanyUser\Business\Reader\RepresentativeCompanyUserReaderInterface;
use FondOfOryx\Zed\RepresentativeCompanyUser\Dependency\Facade\RepresentativeCompanyUserToEventFacadeInterface;
use FondOfOryx\Zed\RepresentativeCompanyUser\Dependency\Service\RepresentativeCompanyUserToUtilUuidGeneratorServiceInterface;
use FondOfOryx\Zed\RepresentativeCompanyUser\Persistence\RepresentativeCompanyUserEntityManagerInterface;
use Generated\Shared\Transfer\RepresentativeCompanyUserCollectionTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTransfer;
use Orm\Zed\RepresentativeCompanyUser\Persistence\Map\FooRepresentativeCompanyUserTableMap;

class RepresentationManager implements RepresentationManagerInterface
{
    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUser\Persistence\RepresentativeCompanyUserEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUser\Business\Reader\RepresentativeCompanyUserReaderInterface
     */
    protected $reader;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUser\Dependency\Facade\RepresentativeCompanyUserToEventFacadeInterface
     */
    protected $eventFacade;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUser\Dependency\Service\RepresentativeCompanyUserToUtilUuidGeneratorServiceInterface
     */
    protected $uuidGenerator;

    /**
     * @param \FondOfOryx\Zed\RepresentativeCompanyUser\Persistence\RepresentativeCompanyUserEntityManagerInterface $entityManager
     * @param \FondOfOryx\Zed\RepresentativeCompanyUser\Business\Reader\RepresentativeCompanyUserReaderInterface $reader
     * @param \FondOfOryx\Zed\RepresentativeCompanyUser\Dependency\Facade\RepresentativeCompanyUserToEventFacadeInterface $eventFacade
     * @param \FondOfOryx\Zed\RepresentativeCompanyUser\Dependency\Service\RepresentativeCompanyUserToUtilUuidGeneratorServiceInterface $uuidGenerator
     */
    public function __construct(
        RepresentativeCompanyUserEntityManagerInterface $entityManager,
        RepresentativeCompanyUserReaderInterface $reader,
        RepresentativeCompanyUserToEventFacadeInterface $eventFacade,
        RepresentativeCompanyUserToUtilUuidGeneratorServiceInterface $uuidGenerator
    ) {
        $this->entityManager = $entityManager;
        $this->reader = $reader;
        $this->eventFacade = $eventFacade;
        $this->uuidGenerator = $uuidGenerator;
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer $filterTransfer
     *
     * @return void
     */
    public function checkForExpiration(RepresentativeCompanyUserFilterTransfer $filterTransfer): void
    {
        $filterTransfer->setStates([FooRepresentativeCompanyUserTableMap::COL_STATE_ACTIVE]);
        $expiredCollection = $this->reader->getExpiredRepresentativeCompanyUser($filterTransfer);
        foreach ($this->setAllInProcess($expiredCollection)->getRepresentations() as $representationTransfer) {
            $this->eventFacade->trigger(
                RepresentativeCompanyUserConstants::REPRESENTATIVE_COMPANY_USER_MARK_FOR_EXPIRE,
                $representationTransfer,
            );
        }
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer $filterTransfer
     *
     * @return void
     */
    public function checkForRevocation(RepresentativeCompanyUserFilterTransfer $filterTransfer): void
    {
        $revokedCollection = $this->reader->getRepresentativeCompanyUserByState(FooRepresentativeCompanyUserTableMap::COL_STATE_REVOKED);
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
        return $this->reader->getRepresentativeCompanyUser($filterTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer $filterTransfer
     *
     * @return void
     */
    public function checkForActivation(RepresentativeCompanyUserFilterTransfer $filterTransfer): void
    {
        $filterTransfer->setStates([FooRepresentativeCompanyUserTableMap::COL_STATE_NEW]);
        foreach ($this->reader->getAndFlagInProcessNewRepresentativeCompanyUser($filterTransfer)->getRepresentations() as $representationTransfer) {
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
        $uuid = $this->uuidGenerator->generateUuid5FromObjectId($this->generateObjectId($representativeCompanyUserTransfer));
        $representativeCompanyUserTransfer->setUuid($uuid);

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
        return $this->reader->getRepresentationByUuid($uuid);
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
            $representation = $this->flagState($representation->getUuid(), FooRepresentativeCompanyUserTableMap::COL_STATE_PROCESS);
            $collection->addRepresentation($representation);
        }

        return $collection;
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer
     *
     * @return string
     */
    protected function generateObjectId(RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer): string
    {
        return sprintf('%s-%s-%s-%s-%s', $representativeCompanyUserTransfer->getFkDistributor(), $representativeCompanyUserTransfer->getFkRepresentative(), $representativeCompanyUserTransfer->getFkOriginator(), $representativeCompanyUserTransfer->getStartDate(), $representativeCompanyUserTransfer->getEndDate());
    }
}
