<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Dependency\Facade;

use FondOfOryx\Zed\RepresentativeCompanyUser\Business\RepresentativeCompanyUserFacadeInterface;
use Generated\Shared\Transfer\RepresentativeCompanyUserTransfer;

class RepresentativeCompanyUserTradeFairToRepresentativeCompanyUserBridge implements RepresentativeCompanyUserTradeFairToRepresentativeCompanyUserInterface
{
    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUser\Business\RepresentativeCompanyUserFacadeInterface
     */
    protected $facade;

    /**
     * @param \FondOfOryx\Zed\RepresentativeCompanyUser\Business\RepresentativeCompanyUserFacadeInterface $representativeCompanyUserFacade
     */
    public function __construct(RepresentativeCompanyUserFacadeInterface $representativeCompanyUserFacade)
    {
        $this->facade = $representativeCompanyUserFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer
     *
     * @return void
     */
    public function deleteCompanyUserForRepresentation(RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer): void
    {
        $this->facade->deleteCompanyUserForRepresentation($representativeCompanyUserTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer
     */
    public function createRepresentativeCompanyUser(RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer): RepresentativeCompanyUserTransfer
    {
        return $this->facade->createRepresentativeCompanyUser($representativeCompanyUserTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer
     */
    public function updateRepresentativeCompanyUser(RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer): RepresentativeCompanyUserTransfer
    {
        return $this->facade->updateRepresentativeCompanyUser($representativeCompanyUserTransfer);
    }
}
