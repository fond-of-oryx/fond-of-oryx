<?php

namespace FondOfOryx\Zed\CompanyTypeProductListsRestApi\Business\Reader;

interface CustomerReaderInterface
{
    /**
     * @param array<int> $companyUserIds
     *
     * @return array<string>
     */
    public function getWhitelistedReferencesByCompanyUserIds(array $companyUserIds): array;
}
