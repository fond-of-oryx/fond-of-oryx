<?php

declare(strict_types = 1);

namespace FondOfOryx\Client\ErpOrderPermission\Plugin\Permission;

use Spryker\Shared\PermissionExtension\Dependency\Plugin\PermissionPluginInterface;

class SeeErpOrdersPermissionPlugin implements PermissionPluginInterface
{
    public const KEY = 'SeeErpOrdersPermissionPlugin';

    /**
     * @return string
     */
    public function getKey(): string
    {
        return static::KEY;
    }
}
