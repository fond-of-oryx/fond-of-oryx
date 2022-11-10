<?php

namespace FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Communication\Plugin\CompanyUsersRestApi;

use FondOfOryx\Zed\CompanyUsersRestApiExtension\Dependency\Plugin\CompanyUserPreCreatePluginInterface;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\RestCompanyUsersRequestAttributesTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Business\CompanyUserCompanyRoleConnectorFacadeInterface getFacade()
 */
class CompanyRoleCompanyUserPreCreatePlugin extends AbstractPlugin implements CompanyUserPreCreatePluginInterface
{
 /**
  * Specification:
  * - Plugin is triggered before company user is created.
  *
  * @api
  *
  * @param \Generated\Shared\Transfer\CompanyUserTransfer $companyUserTransfer
  * @param \Generated\Shared\Transfer\RestCompanyUsersRequestAttributesTransfer $restCompanyUsersRequestAttributesTransfer
  *
  * @return \Generated\Shared\Transfer\CompanyUserTransfer
  */
    public function preCreate(
        CompanyUserTransfer $companyUserTransfer,
        RestCompanyUsersRequestAttributesTransfer $restCompanyUsersRequestAttributesTransfer
    ): CompanyUserTransfer {
        return $this->getFacade()->expandCompanyUserWithCompanyRole(
            $companyUserTransfer,
            $restCompanyUsersRequestAttributesTransfer,
        );
    }
}
