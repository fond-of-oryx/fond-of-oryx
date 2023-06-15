<?php

namespace FondOfOryx\Zed\CompanyTypeRole\Business\Synchronizer;

use FondOfOryx\Zed\CompanyTypeRole\Business\Builder\CompanyRoleCriteriaFilterBuilderInterface;
use FondOfOryx\Zed\CompanyTypeRole\Business\Filter\CompanyTypeNameFilterInterface;
use FondOfOryx\Zed\CompanyTypeRole\Business\Intersection\PermissionIntersectionInterface;
use FondOfOryx\Zed\CompanyTypeRole\CompanyTypeRoleConfig;
use FondOfOryx\Zed\CompanyTypeRole\Dependency\Facade\CompanyTypeRoleToCompanyRoleFacadeInterface;
use FondOfOryx\Zed\CompanyTypeRole\Dependency\Facade\CompanyTypeRoleToPermissionFacadeInterface;
use Generated\Shared\Transfer\CompanyRoleCollectionTransfer;
use Generated\Shared\Transfer\PermissionCollectionTransfer;

class PermissionSynchronizer implements PermissionSynchronizerInterface
{
    /**
     * @var int
     */
    public const PAGINATION_MAX_PER_PAGE = 100;

    /**
     * @var \FondOfOryx\Zed\CompanyTypeRole\Business\Filter\CompanyTypeNameFilterInterface
     */
    protected $companyTypeNameFilter;

    /**
     * @var \FondOfOryx\Zed\CompanyTypeRole\Business\Intersection\PermissionIntersectionInterface
     */
    protected $permissionIntersection;

    /**
     * @var \FondOfOryx\Zed\CompanyTypeRole\Business\Builder\CompanyRoleCriteriaFilterBuilderInterface
     */
    protected $companyRoleCriteriaFilterBuilder;

    /**
     * @var \FondOfOryx\Zed\CompanyTypeRole\Dependency\Facade\CompanyTypeRoleToCompanyRoleFacadeInterface
     */
    protected $companyRoleFacade;

    /**
     * @var \FondOfOryx\Zed\CompanyTypeRole\Dependency\Facade\CompanyTypeRoleToPermissionFacadeInterface
     */
    protected $permissionFacade;

    /**
     * @var \FondOfOryx\Zed\CompanyTypeRole\CompanyTypeRoleConfig
     */
    protected $config;

    /**
     * @param \FondOfOryx\Zed\CompanyTypeRole\Business\Filter\CompanyTypeNameFilterInterface $companyTypeNameFilter
     * @param \FondOfOryx\Zed\CompanyTypeRole\Business\Intersection\PermissionIntersectionInterface $permissionIntersection
     * @param \FondOfOryx\Zed\CompanyTypeRole\Business\Builder\CompanyRoleCriteriaFilterBuilderInterface $companyRoleCriteriaFilterBuilder
     * @param \FondOfOryx\Zed\CompanyTypeRole\Dependency\Facade\CompanyTypeRoleToCompanyRoleFacadeInterface $companyRoleFacade
     * @param \FondOfOryx\Zed\CompanyTypeRole\Dependency\Facade\CompanyTypeRoleToPermissionFacadeInterface $permissionFacade
     * @param \FondOfOryx\Zed\CompanyTypeRole\CompanyTypeRoleConfig $config
     */
    public function __construct(
        CompanyTypeNameFilterInterface $companyTypeNameFilter,
        PermissionIntersectionInterface $permissionIntersection,
        CompanyRoleCriteriaFilterBuilderInterface $companyRoleCriteriaFilterBuilder,
        CompanyTypeRoleToCompanyRoleFacadeInterface $companyRoleFacade,
        CompanyTypeRoleToPermissionFacadeInterface $permissionFacade,
        CompanyTypeRoleConfig $config
    ) {
        $this->companyTypeNameFilter = $companyTypeNameFilter;
        $this->permissionIntersection = $permissionIntersection;
        $this->companyRoleCriteriaFilterBuilder = $companyRoleCriteriaFilterBuilder;
        $this->companyRoleFacade = $companyRoleFacade;
        $this->permissionFacade = $permissionFacade;
        $this->config = $config;
    }

    /**
     * @return void
     */
    public function sync(): void
    {
        $permissionCollectionTransfer = $this->permissionFacade->findAll();

        if ($permissionCollectionTransfer->getPermissions()->count() === 0) {
            return;
        }

        $companyRoleCollectionTransfer = $this->companyRoleFacade->getCompanyRoleCollection(
            $this->companyRoleCriteriaFilterBuilder->buildByPageAndMaxPerPage(1, 1),
        );

        $paginationTransfer = $companyRoleCollectionTransfer->getPagination();

        if ($paginationTransfer === null || $paginationTransfer->getNbResults() === 0) {
            return;
        }

        $page = 1;
        $total = $paginationTransfer->getNbResults();

        while ($page <= ceil($total / static::PAGINATION_MAX_PER_PAGE)) {
            $companyRoleCollectionTransfer = $this->companyRoleFacade->getCompanyRoleCollection(
                $this->companyRoleCriteriaFilterBuilder->buildByPageAndMaxPerPage(
                    $page,
                    static::PAGINATION_MAX_PER_PAGE,
                ),
            );

            $this->syncChunk($companyRoleCollectionTransfer, $permissionCollectionTransfer);

            $page++;
        }
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyRoleCollectionTransfer $companyRoleCollectionTransfer
     * @param \Generated\Shared\Transfer\PermissionCollectionTransfer $permissionCollectionTransfer
     *
     * @return void
     */
    protected function syncChunk(
        CompanyRoleCollectionTransfer $companyRoleCollectionTransfer,
        PermissionCollectionTransfer $permissionCollectionTransfer
    ): void {
        foreach ($companyRoleCollectionTransfer->getRoles() as $companyRoleTransfer) {
            $companyRoleName = $companyRoleTransfer->getName();
            $companyTypeName = $this->companyTypeNameFilter->filterFromCompanyRole($companyRoleTransfer);

            if ($companyTypeName === null || $companyRoleName === null) {
                continue;
            }

            $permissionKeys = $this->config->getPermissionKeys($companyTypeName, $companyRoleName);

            if (count($permissionKeys) === 0) {
                continue;
            }

            $intersectedPermissionCollectionTransfer = $this->permissionIntersection->intersect(
                $permissionCollectionTransfer,
                $permissionKeys,
            );

            $companyRoleTransfer->setPermissionCollection($intersectedPermissionCollectionTransfer);

            $this->companyRoleFacade->update($companyRoleTransfer);
        }
    }
}
