<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApiPermission\Communication\Controller;

use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairRestApiPermissionRequestTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairRestApiPermissionResponseTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method \FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApiPermission\Persistence\RepresentativeCompanyUserTradeFairRestApiPermissionRepositoryInterface getRepository()
 */
class GatewayController extends AbstractGatewayController
{
    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairRestApiPermissionRequestTransfer $representativeCompanyUserTradeFairRestApiPermissionRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairRestApiPermissionResponseTransfer
     */
    public function hasPermissionToManageTradeFairRepresentationsAction(
        RepresentativeCompanyUserTradeFairRestApiPermissionRequestTransfer $representativeCompanyUserTradeFairRestApiPermissionRequestTransfer
    ): RepresentativeCompanyUserTradeFairRestApiPermissionResponseTransfer {
        return (new RepresentativeCompanyUserTradeFairRestApiPermissionResponseTransfer())->setHasPermissionToManageOwnTradeFairRepresentations($this->getRepository()
            ->hasPermission(
                $representativeCompanyUserTradeFairRestApiPermissionRequestTransfer->getPermissionKey(),
                $representativeCompanyUserTradeFairRestApiPermissionRequestTransfer->getOriginatorReference(),
            ))->setRequest($representativeCompanyUserTradeFairRestApiPermissionRequestTransfer);
    }
}
