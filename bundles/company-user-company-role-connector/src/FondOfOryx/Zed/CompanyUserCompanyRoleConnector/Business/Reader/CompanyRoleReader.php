<?php

namespace FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Business\Reader;

use FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Dependency\Facade\CompanyUserCompanyRoleConnectorToCompanyRoleFacadeInterface;
use Generated\Shared\Transfer\CompanyRoleTransfer;
use Generated\Shared\Transfer\RestCompanyUsersRequestAttributesTransfer;

class CompanyRoleReader implements CompanyRoleReaderInterface
{
    /**
     * @var \FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Dependency\Facade\CompanyUserCompanyRoleConnectorToCompanyRoleFacadeInterface
     */
    protected $companyRoleFacade;

    /**
     * @param \FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Dependency\Facade\CompanyUserCompanyRoleConnectorToCompanyRoleFacadeInterface $companyRoleFacade
     */
    public function __construct(
        CompanyUserCompanyRoleConnectorToCompanyRoleFacadeInterface $companyRoleFacade
    ) {
        $this->companyRoleFacade = $companyRoleFacade;
    }

    /**
     * @inheritDoc
     */
    public function getByRestCompanyUsersRequestAttributes(
        RestCompanyUsersRequestAttributesTransfer $restCompanyUsersRequestAttributesTransfer
    ): ?CompanyRoleTransfer {
        $restCompanyRoleTransfer = $restCompanyUsersRequestAttributesTransfer->getCompanyRole();

        if ($restCompanyRoleTransfer === null || $restCompanyRoleTransfer->getUuid() === null) {
            return null;
        }

        $companyRoleTransfer = (new CompanyRoleTransfer())
            ->setUuid($restCompanyRoleTransfer->getUuid());

        $companyRoleResponseTransfer = $this->companyRoleFacade->findCompanyRoleByUuid($companyRoleTransfer);

        $companyRoleTransfer = $companyRoleResponseTransfer->getCompanyRoleTransfer();

        if ($companyRoleTransfer === null || $companyRoleResponseTransfer->getIsSuccessful() !== true) {
            return null;
        }

        return $companyRoleTransfer;
    }
}
