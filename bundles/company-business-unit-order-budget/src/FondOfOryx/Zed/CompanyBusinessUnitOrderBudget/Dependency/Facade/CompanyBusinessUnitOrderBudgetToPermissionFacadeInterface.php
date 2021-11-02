<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Dependency\Facade;

interface CompanyBusinessUnitOrderBudgetToPermissionFacadeInterface
{
    /**
     * @param string $permissionKey
     * @param string|int $identifier
     * @param array|string|int|null $context
     *
     * @return bool
     */
    public function can(string $permissionKey, $identifier, $context = null): bool;
}
