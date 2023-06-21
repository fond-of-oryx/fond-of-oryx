<?php

namespace FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\Permission;

use FondOfOryx\Zed\CompanyUsersBulkRestApi\Communication\Plugin\PermissionExtension\CanBulkCreateCompanyUsersPermissionPlugin;
use FondOfOryx\Zed\CompanyUsersBulkRestApi\Persistence\CompanyUsersBulkRestApiRepositoryInterface;
use Generated\Shared\Transfer\RestCompanyUsersBulkRequestTransfer;

class PermissionChecker implements PermissionCheckerInterface
{
    /**
     * @var \FondOfOryx\Zed\CompanyUsersBulkRestApi\Persistence\CompanyUsersBulkRestApiRepositoryInterface
     */
    protected CompanyUsersBulkRestApiRepositoryInterface $repository;

    /**
     * @param \FondOfOryx\Zed\CompanyUsersBulkRestApi\Persistence\CompanyUsersBulkRestApiRepositoryInterface $repository
     */
    public function __construct(CompanyUsersBulkRestApiRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompanyUsersBulkRequestTransfer $restCompanyUsersBulkRequestTransfer
     * @return bool
     */
    public function check(
        RestCompanyUsersBulkRequestTransfer $restCompanyUsersBulkRequestTransfer
    ): bool {
        return $this->repository->hasPermission(
            CanBulkCreateCompanyUsersPermissionPlugin::KEY,
            $restCompanyUsersBulkRequestTransfer->getOriginatorReference()
        );
    }
}
