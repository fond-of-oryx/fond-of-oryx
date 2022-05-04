<?php

namespace FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Business\Writer;

use FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Dependency\Facade\CompanyUserCompanyRoleConnectorToCompanyRoleFacadeInterface;
use FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Exception\CompanyIdMismatchException;
use FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Exception\CompanyRoleNotFoundException;
use Generated\Shared\Transfer\CompanyRoleCollectionTransfer;
use Generated\Shared\Transfer\CompanyRoleResponseTransfer;
use Generated\Shared\Transfer\CompanyRoleTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\RestCompanyUsersRequestAttributesTransfer;

class CompanyUserCompanyRoleWriter implements CompanyUserCompanyRoleWriterInterface
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
     * @param \Generated\Shared\Transfer\CompanyUserTransfer $companyUserTransfer
     * @param \Generated\Shared\Transfer\RestCompanyUsersRequestAttributesTransfer $companyUsersRequestAttributesTransfer
     *
     * @throws \FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Exception\CompanyIdMismatchException
     * @throws \FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Exception\CompanyRoleNotFoundException
     *
     * @return \Generated\Shared\Transfer\CompanyUserTransfer
     */
    public function saveCompanyUserCompanyRole(
        CompanyUserTransfer $companyUserTransfer,
        RestCompanyUsersRequestAttributesTransfer $companyUsersRequestAttributesTransfer
    ): CompanyUserTransfer {
        if (!$companyUsersRequestAttributesTransfer->getCompanyRole()) {
            return $companyUserTransfer;
        }

        $companyRoleResponseTransfer = $this->findCompanyRole($companyUsersRequestAttributesTransfer);

        if (!$companyRoleResponseTransfer->getIsSuccessful()) {
            throw new CompanyRoleNotFoundException(
                sprintf(
                    'Company role with uuid %s not found!',
                    $companyUsersRequestAttributesTransfer->getCompanyRole()->getUuid(),
                ),
            );
        }

        if (
            $companyUserTransfer->getFkCompany()
            != $companyRoleResponseTransfer->getCompanyRoleTransfer()->getFkCompany()
        ) {
            throw new CompanyIdMismatchException(
                sprintf(
                    'Company id for company user transfer does not equal with company id from company role transfer',
                ),
            );
        }

        $companyUserTransfer->setCompanyRoleCollection(
            $this->getCompanyRoleCollection($companyRoleResponseTransfer->getCompanyRoleTransfer()),
        );

        $this->companyRoleFacade->saveCompanyUser($companyUserTransfer);

        return $companyUserTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyRoleTransfer $companyRoleTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyRoleCollectionTransfer
     */
    protected function getCompanyRoleCollection(
        CompanyRoleTransfer $companyRoleTransfer
    ): CompanyRoleCollectionTransfer {
        return (new CompanyRoleCollectionTransfer())->addRole($companyRoleTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompanyUsersRequestAttributesTransfer $companyUsersRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyRoleResponseTransfer
     */
    protected function findCompanyRole(
        RestCompanyUsersRequestAttributesTransfer $companyUsersRequestAttributesTransfer
    ): CompanyRoleResponseTransfer {
        $companyRoleTransfer = (new CompanyRoleTransfer())
            ->setUuid($companyUsersRequestAttributesTransfer->getCompanyRole()->getUuid());

        return $this->companyRoleFacade->findCompanyRoleByUuid($companyRoleTransfer);
    }
}
