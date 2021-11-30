<?php

namespace FondOfOryx\Zed\CompanyCompanyUserGui\Persistence;

use Generated\Shared\Transfer\CompanyTransfer;

interface CompanyCompanyUserGuiRepositoryInterface
{
    /**
     * @param int $idCompany
     *
     * @return \Generated\Shared\Transfer\CompanyTransfer|null
     */
    public function getByIdCompany(int $idCompany): ?CompanyTransfer;

    /**
     * @param string $namePattern
     *
     * @return array<\Generated\Shared\Transfer\CompanyTransfer>
     */
    public function findByNamePattern(string $namePattern): array;
}
