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
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserRestApiPermissionRequestTransfer $companiesRestApiPermissionRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserRestApiPermissionResponseTransfer
     */
    public function hasPermissionToManageOwnRepresentationsAction(
        RepresentativeCompanyUserRestApiPermissionRequestTransfer $companiesRestApiPermissionRequestTransfer
    ): RepresentativeCompanyUserRestApiPermissionResponseTransfer {
        return (new RepresentativeCompanyUserRestApiPermissionResponseTransfer())->setHasPermissionToManageOwnRepresentations($this->getRepository()
            ->hasPermission(
                $companiesRestApiPermissionRequestTransfer->getPermissionKey(),
                $companiesRestApiPermissionRequestTransfer->getOriginatorReference(),
            ))->setRequest($companiesRestApiPermissionRequestTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserRestApiPermissionRequestTransfer $companiesRestApiPermissionRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserRestApiPermissionResponseTransfer
     */
    public function hasPermissionToManageGlobalRepresentationsAction(
        RepresentativeCompanyUserRestApiPermissionRequestTransfer $companiesRestApiPermissionRequestTransfer
    ): RepresentativeCompanyUserRestApiPermissionResponseTransfer {
        return (new RepresentativeCompanyUserRestApiPermissionResponseTransfer())->setHasPermissionToManageGlobalRepresentations($this->getRepository()
            ->hasPermission(
                $companiesRestApiPermissionRequestTransfer->getPermissionKey(),
                $companiesRestApiPermissionRequestTransfer->getOriginatorReference(),
            ))->setRequest($companiesRestApiPermissionRequestTransfer);
    }
}
