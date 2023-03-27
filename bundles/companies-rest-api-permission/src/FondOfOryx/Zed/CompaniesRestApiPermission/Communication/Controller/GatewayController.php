<?php

namespace FondOfOryx\Zed\CompaniesRestApiPermission\Communication\Controller;

use Generated\Shared\Transfer\CompaniesRestApiPermissionRequestTransfer;
use Generated\Shared\Transfer\CompaniesRestApiPermissionResponseTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method \FondOfOryx\Zed\CompaniesRestApiPermission\Persistence\CompaniesRestApiPermissionRepositoryInterface getRepository()
 */
class GatewayController extends AbstractGatewayController
{
    /**
     * @param \Generated\Shared\Transfer\CompaniesRestApiPermissionRequestTransfer $companiesRestApiPermissionRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CompaniesRestApiPermissionResponseTransfer
     */
    public function hasPermissionToDeleteCompanyAction(
        CompaniesRestApiPermissionRequestTransfer $companiesRestApiPermissionRequestTransfer
    ): CompaniesRestApiPermissionResponseTransfer {
        return (new CompaniesRestApiPermissionResponseTransfer())->setHasPermissionToDelete($this->getRepository()
            ->hasPermissionToDeleteCompany(
                $companiesRestApiPermissionRequestTransfer->getPermissionKey(),
                $companiesRestApiPermissionRequestTransfer->getCustomerReference(),
                $companiesRestApiPermissionRequestTransfer->getCompanyUuid(),
            ))->setRequest($companiesRestApiPermissionRequestTransfer);
    }
}
