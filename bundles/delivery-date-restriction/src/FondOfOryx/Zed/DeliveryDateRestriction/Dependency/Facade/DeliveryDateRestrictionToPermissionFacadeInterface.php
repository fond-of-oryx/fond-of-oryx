<?php

namespace FondOfOryx\Zed\DeliveryDateRestriction\Dependency\Facade;

interface DeliveryDateRestrictionToPermissionFacadeInterface
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
