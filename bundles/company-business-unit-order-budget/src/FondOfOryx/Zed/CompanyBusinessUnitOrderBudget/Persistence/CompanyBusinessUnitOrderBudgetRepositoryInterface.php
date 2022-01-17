<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Persistence;

interface CompanyBusinessUnitOrderBudgetRepositoryInterface
{
    /**
     * @return array<int>
     */
    public function getCompanyBusinessUnitIdsWithoutOrderBudget(): array;
}
