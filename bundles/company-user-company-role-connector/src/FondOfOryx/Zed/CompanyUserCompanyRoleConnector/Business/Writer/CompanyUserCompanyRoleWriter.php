<?php

namespace FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Business\Writer;

use FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Business\Expander\CompanyUserExpanderInterface;
use FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Dependency\Facade\CompanyUserCompanyRoleConnectorToCompanyRoleFacadeInterface;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\RestCompanyUsersRequestAttributesTransfer;

class CompanyUserCompanyRoleWriter implements CompanyUserCompanyRoleWriterInterface
{
    /**
     * @var \FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Business\Expander\CompanyUserExpanderInterface
     */
    protected $companyUserExpander;

    /**
     * @var \FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Dependency\Facade\CompanyUserCompanyRoleConnectorToCompanyRoleFacadeInterface
     */
    protected $companyRoleFacade;

    /**
     * @param \FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Business\Expander\CompanyUserExpanderInterface $companyUserExpander
     * @param \FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Dependency\Facade\CompanyUserCompanyRoleConnectorToCompanyRoleFacadeInterface $companyRoleFacade
     */
    public function __construct(
        CompanyUserExpanderInterface $companyUserExpander,
        CompanyUserCompanyRoleConnectorToCompanyRoleFacadeInterface $companyRoleFacade
    ) {
        $this->companyUserExpander = $companyUserExpander;
        $this->companyRoleFacade = $companyRoleFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyUserTransfer $companyUserTransfer
     * @param \Generated\Shared\Transfer\RestCompanyUsersRequestAttributesTransfer $companyUsersRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUserTransfer
     */
    public function saveCompanyUserCompanyRole(
        CompanyUserTransfer $companyUserTransfer,
        RestCompanyUsersRequestAttributesTransfer $companyUsersRequestAttributesTransfer
    ): CompanyUserTransfer {
        $this->companyUserExpander->expand(
            $companyUserTransfer,
            $companyUsersRequestAttributesTransfer,
        );

        $companyRoleCollectionTransfer = $companyUserTransfer->getCompanyRoleCollection();

        if ($companyRoleCollectionTransfer === null || $companyRoleCollectionTransfer->getRoles()->count() < 1) {
            return $companyUserTransfer;
        }

        $this->companyRoleFacade->saveCompanyUser($companyUserTransfer);

        return $companyUserTransfer;
    }
}
