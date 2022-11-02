<?php

namespace FondOfOryx\Zed\CompanyTypeProductListsRestApi\Persistence;

interface CompanyTypeProductListsRestApiRepositoryInterface
{
    /**
     * @param int $currentIdCustomer
     * @param array<string> $customerReferences
     *
     * @return array<int>
     */
    public function getAuthorizedCompanyUserIdsByCurrentIdCustomerAndCustomerReferences(
        int $currentIdCustomer,
        array $customerReferences
    ): array;

    /**
     * @param int $currentIdCustomer
     * @param array<string> $companyUuids
     *
     * @return array<int>
     */
    public function getAuthorizedCompanyUserIdsByCurrentIdCustomerAndCompanyUuids(
        int $currentIdCustomer,
        array $companyUuids
    ): array;

    /**
     * @param array<int> $companyUserIds
     *
     * @return array<string>
     */
    public function getWhitelistedCustomerReferencesByCompanyUserIds(array $companyUserIds): array;

    /**
     * @param array<int> $companyUserIds
     *
     * @return array<string>
     */
    public function getWhitelistedCompanyUuidsByCompanyUserIds(array $companyUserIds): array;
}
