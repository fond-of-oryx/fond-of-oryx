<?php

namespace FondOfOryx\Zed\DeliveryDateRestriction\Dependency\Facade;

interface DeliveryDateRestrictionToPermissionFacadeInterface
{
    /**
     * @param string $permissionKey
     * @param int|string $identifier
     * @param int|string|array|null $context
     *
     * @return bool
     */
    public function can(string $permissionKey, $identifier, $context = null): bool;
}
