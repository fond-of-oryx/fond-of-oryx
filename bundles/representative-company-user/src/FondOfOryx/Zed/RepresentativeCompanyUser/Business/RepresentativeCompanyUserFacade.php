<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUser\Business;

use Generated\Shared\Transfer\RepresentativeCompanyUserCollectionTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserCommandTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\RepresentativeCompanyUser\Business\RepresentativeCompanyUserBusinessFactory getFactory()
 */
class RepresentativeCompanyUserFacade extends AbstractFacade implements RepresentativeCompanyUserFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer $filterTransfer
     *
     * @return void
     */
    public function checkForExpiration(RepresentativeCompanyUserFilterTransfer $filterTransfer): void
    {
        $this->getFactory()->createRepresentationManager()->checkForExpiration($filterTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer $filterTransfer
     *
     * @return void
     */
    public function checkForActivation(RepresentativeCompanyUserFilterTransfer $filterTransfer): void
    {
        $this->getFactory()->createRepresentationManager()->checkForActivation($filterTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer $filterTransfer
     *
     * @return void
     */
    public function checkForRevocation(RepresentativeCompanyUserFilterTransfer $filterTransfer): void
    {
        $this->getFactory()->createRepresentationManager()->checkForRevocation($filterTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer
     */
    public function createRepresentativeCompanyUser(RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer): RepresentativeCompanyUserTransfer
    {
        return $this->getFactory()->createRepresentationManager()->addRepresentation($representativeCompanyUserTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer
     */
    public function updateRepresentativeCompanyUser(RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer): RepresentativeCompanyUserTransfer
    {
        return $this->getFactory()->createRepresentationManager()->updateRepresentation($representativeCompanyUserTransfer);
    }

    /**
     * @param string $uuid
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer
     */
    public function findRepresentationByUuid(string $uuid): RepresentativeCompanyUserTransfer
    {
        return $this->getFactory()->createRepresentationManager()->findByUuid($uuid);
    }

    /**
     * @param string $uuid
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer
     */
    public function deleteRepresentativeCompanyUser(string $uuid): RepresentativeCompanyUserTransfer
    {
        return $this->getFactory()->createRepresentationManager()->deleteRepresentativeCompanyUser($uuid);
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer
     *
     * @return void
     */
    public function deleteCompanyUserForRepresentation(RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer): void
    {
        $this->getFactory()->createCompanyUserManager()->deleteCompanyUserForRepresentation($representativeCompanyUserTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer
     *
     * @return void
     */
    public function createCompanyUserForRepresentation(RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer): void
    {
        $this->getFactory()->createCompanyUserManager()->createCompanyUserForRepresentation($representativeCompanyUserTransfer);
    }

    /**
     * @param string $uuid
     * @param string $state
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer
     */
    public function setRepresentationState(string $uuid, string $state): RepresentativeCompanyUserTransfer
    {
        return $this->getFactory()->createRepresentationManager()->flagState($uuid, $state);
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer $filterTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserCollectionTransfer
     */
    public function getAndFlagInProcessNewRepresentativeCompanyUser(
        RepresentativeCompanyUserFilterTransfer $filterTransfer
    ): RepresentativeCompanyUserCollectionTransfer {
        return $this->getFactory()->createRepresentativeCompanyUserReader()->getAndFlagInProcessNewRepresentativeCompanyUser($filterTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserCollectionTransfer $representativeCompanyUserCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserCollectionTransfer
     */
    public function setInProcess(
        RepresentativeCompanyUserCollectionTransfer $representativeCompanyUserCollectionTransfer
    ): RepresentativeCompanyUserCollectionTransfer {
        return $this->getFactory()->createRepresentationManager()->setAllInProcess($representativeCompanyUserCollectionTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserCommandTransfer $commandTransfer
     *
     * @return void
     */
    public function runTask(RepresentativeCompanyUserCommandTransfer $commandTransfer): void
    {
        $this->getFactory()->createTaskRunner()->runTask($commandTransfer);
    }

    /**
     * @return array<string>
     */
    public function getRegisteredProcessorNames(): array
    {
        return $this->getFactory()->createTaskRunner()->getRegisteredProcessorNames();
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer $filterTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserCollectionTransfer
     */
    public function getRepresentativeCompanyUser(RepresentativeCompanyUserFilterTransfer $filterTransfer): RepresentativeCompanyUserCollectionTransfer
    {
        return $this->getFactory()->createRepresentationManager()->getRepresentativeCompanyUser($filterTransfer);
    }
}
