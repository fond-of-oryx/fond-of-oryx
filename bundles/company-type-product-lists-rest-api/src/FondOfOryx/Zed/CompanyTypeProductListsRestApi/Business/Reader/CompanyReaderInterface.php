<?php

namespace FondOfOryx\Zed\CompanyTypeProductListsRestApi\Business\Reader;

interface CompanyReaderInterface
{
    /**
     * @param array<int> $companyUserIds
     *
     * @return array<string>
     */
    public function getWhitelistedUuidsByCompanyUserIds(array $companyUserIds): array;
}
