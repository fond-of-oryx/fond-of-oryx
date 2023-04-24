<?php

declare(strict_types = 1);

namespace FondOfOryx\Zed\RepresentationOfSalesPermission\Communication\Plugin\Permission;

use Spryker\Shared\PermissionExtension\Dependency\Plugin\PermissionPluginInterface;

class CanManageRepresentationPermissionPlugin implements PermissionPluginInterface
{
    /**
     * @var string
     */
    public const KEY = 'CanManageRepresentationPermissionPlugin';

    /**
     * @return string
     */
    public function getKey(): string
    {
        return static::KEY;
    }
}
