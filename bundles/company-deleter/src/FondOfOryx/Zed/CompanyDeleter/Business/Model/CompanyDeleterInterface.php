<?php

namespace FondOfOryx\Zed\CompanyDeleter\Business\Model;

interface CompanyDeleterInterface
{
    /**
     * @param array $idCompanies
     *
     * @return void
     */
    public function delete(array $idCompanies): void;
}
