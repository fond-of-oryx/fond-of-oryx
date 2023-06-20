<?php

namespace FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\Manager;

use FondOfOryx\Shared\CompanyUsersBulkRestApi\CompanyUsersBulkRestApiConstants;
use FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\Permission\PermissionCheckerInterface;
use Generated\Shared\Transfer\RestCompanyUsersBulkRequestTransfer;
use Generated\Shared\Transfer\RestCompanyUsersBulkResponseTransfer;

class BulkManager implements BulkManagerInterface
{
    protected PermissionCheckerInterface $permissionChecker;

    public function __construct(PermissionCheckerInterface $permissionChecker)
    {
        $this->permissionChecker = $permissionChecker;
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompanyUsersBulkRequestTransfer $restCompanyUsersBulkRequestTransfer
     * @return \Generated\Shared\Transfer\RestCompanyUsersBulkResponseTransfer
     */
    public function handleBulkRequest(
        RestCompanyUsersBulkRequestTransfer $restCompanyUsersBulkRequestTransfer
    ): RestCompanyUsersBulkResponseTransfer
    {
        if (!$this->permissionChecker->checkPermission($restCompanyUsersBulkRequestTransfer)){
            return $this->createEmptyResponseTransfer()
                ->setCode(CompanyUsersBulkRestApiConstants::ERROR_CODE_PERMISSION_DENIED)
                ->setError(CompanyUsersBulkRestApiConstants::ERROR_MESSAGE_MISSING_PERMISSION);
        }

        return $this->createEmptyResponseTransfer();
    }

    /**
     * @return \Generated\Shared\Transfer\RestCompanyUsersBulkResponseTransfer
     */
    protected function createEmptyResponseTransfer(): RestCompanyUsersBulkResponseTransfer{
        return new RestCompanyUsersBulkResponseTransfer();
    }
}
