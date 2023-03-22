<?php

namespace FondOfOryx\Zed\CompanyDeleter\Business;

interface CompanyDeleterFacadeInterface
{
    /**
     * @param array $ids
     *
     * @return array<string, array<int>>
     */
    public function deleteCompanies(array $ids): array;

    /**
     * @param int $id
     *
     * @return array<string, array<int>>
     */
    public function deleteCompany(int $id): array;
}
