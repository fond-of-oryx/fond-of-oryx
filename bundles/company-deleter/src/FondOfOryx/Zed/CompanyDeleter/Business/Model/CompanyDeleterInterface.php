<?php

namespace FondOfOryx\Zed\CompanyDeleter\Business\Model;

interface CompanyDeleterInterface
{
    /**
     * @param array $idCompanies
     *
     * @return array<string, array<int>>
     */
    public function delete(array $idCompanies): array;
}
