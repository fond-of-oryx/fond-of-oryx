<?php

namespace FondOfOryx\Zed\CompanyUsersBulkRestApi\Persistence;

interface CompanyUsersBulkRestApiRepositoryInterface
{
    /**
     * @param string $permissionKey
     * @param string $customerReference
     *
     * @return bool
     */
    public function hasPermission(
        string $permissionKey,
        string $customerReference
    ): bool;
}
