<?php

namespace FondOfOryx\Zed\CompanyTypeRole\Business\Reader;

use FondOfOryx\Zed\CompanyTypeRole\Dependency\Facade\CompanyTypeRoleToCompanyUserFacadeInterface;
use FondOfOryx\Zed\CompanyTypeRole\Persistence\CompanyTypeRoleRepositoryInterface;
use Generated\Shared\Transfer\AssignableCompanyRoleCriteriaFilterTransfer;
use Generated\Shared\Transfer\CompanyUserCollectionTransfer;
use Generated\Shared\Transfer\CompanyUserCriteriaFilterTransfer;

class CompanyUserReader implements CompanyUserReaderInterface
{
    /**
     * @var \FondOfOryx\Zed\CompanyTypeRole\Dependency\Facade\CompanyTypeRoleToCompanyUserFacadeInterface
     */
    protected $companyUserFacade;

    /**
     * @var \FondOfOryx\Zed\CompanyTypeRole\Persistence\CompanyTypeRoleRepositoryInterface
     */
    protected $repository;

    /**
     * @param \FondOfOryx\Zed\CompanyTypeRole\Dependency\Facade\CompanyTypeRoleToCompanyUserFacadeInterface $companyUserFacade
     * @param \FondOfOryx\Zed\CompanyTypeRole\Persistence\CompanyTypeRoleRepositoryInterface $repository
     */
    public function __construct(
        CompanyTypeRoleToCompanyUserFacadeInterface $companyUserFacade,
        CompanyTypeRoleRepositoryInterface $repository
    ) {
        $this->companyUserFacade = $companyUserFacade;
        $this->repository = $repository;
    }

    /**
     * @param \Generated\Shared\Transfer\AssignableCompanyRoleCriteriaFilterTransfer $assignableCompanyRoleCriteriaFilterTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUserCollectionTransfer
     */
    public function getByAssignableCompanyRoleCriteriaFilter(
        AssignableCompanyRoleCriteriaFilterTransfer $assignableCompanyRoleCriteriaFilterTransfer
    ): CompanyUserCollectionTransfer {
        $idCustomer = $assignableCompanyRoleCriteriaFilterTransfer->getIdCustomer();

        if ($idCustomer === null) {
            return new CompanyUserCollectionTransfer();
        }

        $activeCompanyUserIds = $this->repository->findActiveCompanyUserIdsByIdCustomer($idCustomer);

        if (count($activeCompanyUserIds) === 0) {
            return new CompanyUserCollectionTransfer();
        }

        $companyUserCriteriaFilterTransfer = (new CompanyUserCriteriaFilterTransfer())
            ->setIdCompany($assignableCompanyRoleCriteriaFilterTransfer->getIdCompany())
            ->setCompanyUserIds($activeCompanyUserIds)
            ->setIsActive(true);

        return $this->companyUserFacade->getCompanyUserCollection($companyUserCriteriaFilterTransfer);
    }
}
