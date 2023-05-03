<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Dependency\Facade;

use FondOfOryx\Zed\RepresentativeCompanyUser\Business\RepresentativeCompanyUserFacadeInterface;
use Generated\Shared\Transfer\RepresentativeCompanyUserTransfer;

class RepresentativeCompanyUserRestApiToRepresentativeCompanyUserFacadeBridge implements RepresentativeCompanyUserRestApiToRepresentativeCompanyUserFacadeInterface
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
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer
     */
    public function addRepresentativeCompanyUser(RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer): RepresentativeCompanyUserTransfer
    {
        return $this->facade->createRepresentativeCompanyUser($representativeCompanyUserTransfer);
    }
}
