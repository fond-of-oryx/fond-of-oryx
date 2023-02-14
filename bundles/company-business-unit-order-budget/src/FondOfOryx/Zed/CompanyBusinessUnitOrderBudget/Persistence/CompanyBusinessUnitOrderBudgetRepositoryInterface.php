<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Persistence;

interface CompanyBusinessUnitOrderBudgetRepositoryInterface
{
    /**
     * @return array<int>
     */
    public function getCompanyBusinessUnitIdsWithoutOrderBudget(): array;

    /**
     * @param int $idCompanyBusinessUnit
     *
     * @return int|null
     */
    public function getIdOrderBudgetByIdCompanyBusinessUnit(int $idCompanyBusinessUnit): ?int;
}
