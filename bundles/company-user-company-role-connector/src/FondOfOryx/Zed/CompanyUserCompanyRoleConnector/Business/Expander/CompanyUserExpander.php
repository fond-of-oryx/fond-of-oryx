<?php

namespace FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Business\Expander;

use FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Business\Reader\CompanyRoleReaderInterface;
use FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Exception\CompanyIdMismatchException;
use FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Exception\CompanyRoleNotFoundException;
use Generated\Shared\Transfer\CompanyRoleCollectionTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\RestCompanyUsersRequestAttributesTransfer;

class CompanyUserExpander implements CompanyUserExpanderInterface
{
    /**
     * @var \FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Business\Reader\CompanyRoleReaderInterface
     */
    protected $companyRoleReader;

    /**
     * @param \FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Business\Reader\CompanyRoleReaderInterface $companyRoleReader
     */
    public function __construct(CompanyRoleReaderInterface $companyRoleReader)
    {
        $this->companyRoleReader = $companyRoleReader;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyUserTransfer $companyUserTransfer
     * @param \Generated\Shared\Transfer\RestCompanyUsersRequestAttributesTransfer $restCompanyUsersRequestAttributesTransfer
     *
     * @throws \FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Exception\CompanyRoleNotFoundException
     * @throws \FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Exception\CompanyIdMismatchException
     *
     * @return \Generated\Shared\Transfer\CompanyUserTransfer
     */
    public function expand(
        CompanyUserTransfer $companyUserTransfer,
        RestCompanyUsersRequestAttributesTransfer $restCompanyUsersRequestAttributesTransfer
    ): CompanyUserTransfer {
        $companyRoleTransfer = $this->companyRoleReader->getByRestCompanyUsersRequestAttributes(
            $restCompanyUsersRequestAttributesTransfer,
        );

        if ($companyRoleTransfer === null) {
            throw new CompanyRoleNotFoundException('Company role does not exists.');
        }

        if ($companyUserTransfer->getFkCompany() !== $companyRoleTransfer->getFkCompany()) {
            throw new CompanyIdMismatchException('Company role belongs to another company.');
        }

        $companyRoleCollectionTransfer = (new CompanyRoleCollectionTransfer())
            ->addRole($companyRoleTransfer);

        return $companyUserTransfer->setCompanyRoleCollection($companyRoleCollectionTransfer);
    }
}
