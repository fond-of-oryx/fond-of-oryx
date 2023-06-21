<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserRestApiPermission\Communication\Controller;

use Generated\Shared\Transfer\RepresentativeCompanyUserRestApiPermissionRequestTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserRestApiPermissionResponseTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method \FondOfOryx\Zed\RepresentativeCompanyUserRestApiPermission\Persistence\RepresentativeCompanyUserRestApiPermissionRepositoryInterface getRepository()
 */
class GatewayController extends AbstractGatewayController
{
    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserRestApiPermissionRequestTransfer $representativeCompanyUserRestApiPermissionRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserRestApiPermissionResponseTransfer
     */
    public function hasPermissionToManageOwnRepresentationsAction(
        RepresentativeCompanyUserRestApiPermissionRequestTransfer $representativeCompanyUserRestApiPermissionRequestTransfer
    ): RepresentativeCompanyUserRestApiPermissionResponseTransfer {
        return (new RepresentativeCompanyUserRestApiPermissionResponseTransfer())->setHasPermissionToManageOwnRepresentations($this->getRepository()
            ->hasPermission(
                $representativeCompanyUserRestApiPermissionRequestTransfer->getPermissionKey(),
                $representativeCompanyUserRestApiPermissionRequestTransfer->getOriginatorReference(),
            ))->setRequest($representativeCompanyUserRestApiPermissionRequestTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserRestApiPermissionRequestTransfer $representativeCompanyUserRestApiPermissionRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserRestApiPermissionResponseTransfer
     */
    public function hasPermissionToManageGlobalRepresentationsAction(
        RepresentativeCompanyUserRestApiPermissionRequestTransfer $representativeCompanyUserRestApiPermissionRequestTransfer
    ): RepresentativeCompanyUserRestApiPermissionResponseTransfer {
        return (new RepresentativeCompanyUserRestApiPermissionResponseTransfer())->setHasPermissionToManageGlobalRepresentations($this->getRepository()
            ->hasPermission(
                $representativeCompanyUserRestApiPermissionRequestTransfer->getPermissionKey(),
                $representativeCompanyUserRestApiPermissionRequestTransfer->getOriginatorReference(),
            ))->setRequest($representativeCompanyUserRestApiPermissionRequestTransfer);
    }
}
