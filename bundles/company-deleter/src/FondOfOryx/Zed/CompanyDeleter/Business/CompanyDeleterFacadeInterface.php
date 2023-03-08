<?php

namespace FondOfOryx\Zed\CompanyDeleter\Business;

interface CompanyDeleterFacadeInterface
{
    /**
     * @param array $ids
     *
     * @return void
     */
    public function deleteCompanies(array $ids): void;

    /**
     * @param int $id
     *
     * @return void
     */
    public function deleteCompany(int $id): void;
}
