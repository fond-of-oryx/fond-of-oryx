<?php

namespace FondOfOryx\Zed\CompanyProductListSearchRestApi\Dependency\Facade;

interface CompanyProductListSearchRestApiToPermissionFacadeInterface
{
    /**
     * @param string $permissionKey
     * @param string|int $identifier
     * @param array|string|int|null $context
     *
     * @return bool
     */
    public function can(
        string $permissionKey,
        string|int $identifier,
        array|string|int|null $context = null
    ): bool;
}
