<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Dependency\Facade;

use Spryker\Zed\Permission\Business\PermissionFacadeInterface;

interface RepresentativeCompanyUserRestApiToRepresentativeCompanyUserRestApiPermissionFacadeInterface
{
    /**
     * @param string $permissionKey
     * @param string $customerReference
     * @return bool
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function can(string $permissionKey, string $customerReference): bool;
}
