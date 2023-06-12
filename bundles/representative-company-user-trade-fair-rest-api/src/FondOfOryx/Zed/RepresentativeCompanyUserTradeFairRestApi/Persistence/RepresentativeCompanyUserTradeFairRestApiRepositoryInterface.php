<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Persistence;

interface RepresentativeCompanyUserTradeFairRestApiRepositoryInterface
{
    /**
     * @param string $customerReference
     *
     * @throws \Exception
     *
     * @return int
     */
    public function getIdCustomerByReference(string $customerReference): int;

    /**
     * @param string $permissionKey
     * @param string $customerReference
     * @param int $companyTypeId
     *
     * @return bool
     */
    public function hasPermission(
        string $permissionKey,
        string $customerReference,
        int $companyTypeId
    ): bool;
}
