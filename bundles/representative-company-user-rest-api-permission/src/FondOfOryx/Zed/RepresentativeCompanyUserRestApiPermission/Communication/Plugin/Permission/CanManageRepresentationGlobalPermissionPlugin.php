<?php

declare(strict_types = 1);

namespace FondOfOryx\Zed\RepresentativeCompanyUserRestApiPermission\Communication\Plugin\Permission;

use Spryker\Shared\PermissionExtension\Dependency\Plugin\PermissionPluginInterface;

class CanManageRepresentationGlobalPermissionPlugin implements PermissionPluginInterface
{
    /**
     * @var string
     */
    public const KEY = 'CanManageRepresentationGlobalPermissionPlugin';

    /**
     * @return string
     */
    public function getKey(): string
    {
        return static::KEY;
    }
}
