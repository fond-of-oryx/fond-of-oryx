<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Dependency\Facade;

interface RepresentativeCompanyUserRestApiToRepresentativeCompanyUserRestApiPermissionFacadeInterface
{
    /**
     * @param string $permissionKey
     * @param string $customerReference
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     *
     * @return bool
     */
    public function can(string $permissionKey, string $customerReference): bool;
}
