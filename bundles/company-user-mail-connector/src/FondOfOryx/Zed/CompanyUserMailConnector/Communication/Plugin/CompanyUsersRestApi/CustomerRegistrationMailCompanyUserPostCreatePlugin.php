<?php

namespace FondOfOryx\Zed\CompanyUserMailConnector\Communication\Plugin\CompanyUsersRestApi;

use FondOfOryx\Zed\CompanyUsersRestApiExtension\Dependency\Plugin\CompanyUserPostCreatePluginInterface;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\RestCompanyUsersRequestAttributesTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\CompanyUserMailConnector\Business\CompanyUserMailConnectorFacadeInterface getFacade()
 */
class CustomerRegistrationMailCompanyUserPostCreatePlugin extends AbstractPlugin implements CompanyUserPostCreatePluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyUserTransfer $companyUserTransfer
     * @param \Generated\Shared\Transfer\RestCompanyUsersRequestAttributesTransfer $restCompanyUsersRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUserTransfer
     */
    public function postCreate(
        CompanyUserTransfer $companyUserTransfer,
        RestCompanyUsersRequestAttributesTransfer $restCompanyUsersRequestAttributesTransfer
    ): CompanyUserTransfer {
        return $this->getFacade()->sendMail($companyUserTransfer);
    }
}
