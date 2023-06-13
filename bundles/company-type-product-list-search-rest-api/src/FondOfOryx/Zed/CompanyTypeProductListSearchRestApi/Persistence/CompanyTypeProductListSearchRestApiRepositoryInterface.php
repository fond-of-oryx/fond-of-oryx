<?php

namespace FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Persistence;

interface CompanyTypeProductListSearchRestApiRepositoryInterface
{
    /**
     * @param int $currentIdCustomer
     * @param string $customerReference
     *
     * @return bool
     */
    public function canSeeProductListsOfCustomer(
        int $currentIdCustomer,
        string $customerReference
    ): bool;
}
