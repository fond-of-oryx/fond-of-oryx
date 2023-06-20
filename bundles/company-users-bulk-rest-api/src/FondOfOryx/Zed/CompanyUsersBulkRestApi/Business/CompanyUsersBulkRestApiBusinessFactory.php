<?php

namespace FondOfOryx\Zed\CompanyUsersBulkRestApi\Business;

use FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\Manager\BulkManager;
use FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\Manager\BulkManagerInterface;
use FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\Permission\PermissionChecker;
use FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\Permission\PermissionCheckerInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\CompanyUsersBulkRestApi\CompanyUsersBulkRestApiConfig getConfig()
 * @method \FondOfOryx\Zed\CompanyUsersBulkRestApi\Persistence\CompanyUsersBulkRestApiRepositoryInterface getRepository()
 */
class CompanyUsersBulkRestApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\Manager\BulkManagerInterface
     */
    public function createBulkManager(): BulkManagerInterface
    {
        return new BulkManager(
            $this->createPermissionChecker()
        );
    }

    /**
     * @return \FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\Permission\PermissionCheckerInterface
     */
    public function createPermissionChecker(): PermissionCheckerInterface
    {
        return new PermissionChecker($this->getRepository());
    }
}
