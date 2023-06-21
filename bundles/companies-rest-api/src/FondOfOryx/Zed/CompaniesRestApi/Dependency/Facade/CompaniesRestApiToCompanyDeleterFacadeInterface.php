<?php

namespace FondOfOryx\Zed\CompaniesRestApi\Dependency\Facade;

interface CompaniesRestApiToCompanyDeleterFacadeInterface
{
    /**
     * @param int $companyId
     *
     * @return array
     */
    public function deleteCompany(int $companyId): array;
}
