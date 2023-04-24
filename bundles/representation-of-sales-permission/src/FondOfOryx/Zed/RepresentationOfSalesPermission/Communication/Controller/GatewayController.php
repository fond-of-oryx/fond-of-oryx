<?php

namespace FondOfOryx\Zed\RepresentationOfSalesPermission\Communication\Controller;

use Generated\Shared\Transfer\RepresentationOfSalesPermissionRequestTransfer;
use Generated\Shared\Transfer\RepresentationOfSalesPermissionResponseTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method \FondOfOryx\Zed\RepresentationOfSalesPermission\Persistence\RepresentationOfSalesPermissionRepositoryInterface getRepository()
 */
class GatewayController extends AbstractGatewayController
{
    /**
     * @param \Generated\Shared\Transfer\RepresentationOfSalesPermissionRequestTransfer $companiesRestApiPermissionRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentationOfSalesPermissionResponseTransfer
     */
    public function hasPermissionToManageOwnRepresentationsAction(
        RepresentationOfSalesPermissionRequestTransfer $companiesRestApiPermissionRequestTransfer
    ): RepresentationOfSalesPermissionResponseTransfer {
        return (new RepresentationOfSalesPermissionResponseTransfer())->setHasPermissionToManageOwnRepresentations($this->getRepository()
            ->hasPermission(
                $companiesRestApiPermissionRequestTransfer->getPermissionKey(),
                $companiesRestApiPermissionRequestTransfer->getOriginatorReference(),
            ))->setRequest($companiesRestApiPermissionRequestTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentationOfSalesPermissionRequestTransfer $companiesRestApiPermissionRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentationOfSalesPermissionResponseTransfer
     */
    public function hasPermissionToManageGlobalRepresentationsAction(
        RepresentationOfSalesPermissionRequestTransfer $companiesRestApiPermissionRequestTransfer
    ): RepresentationOfSalesPermissionResponseTransfer {
        return (new RepresentationOfSalesPermissionResponseTransfer())->setHasPermissionToManageGlobalRepresentations($this->getRepository()
            ->hasPermission(
                $companiesRestApiPermissionRequestTransfer->getPermissionKey(),
                $companiesRestApiPermissionRequestTransfer->getOriginatorReference(),
            ))->setRequest($companiesRestApiPermissionRequestTransfer);
    }
}
