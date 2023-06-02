<?php

declare(strict_types = 1);

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApiPermission\Communication\Plugin\Permission;

use Spryker\Shared\PermissionExtension\Dependency\Plugin\PermissionPluginInterface;

class CanManageRepresentationOnTradeFairPermissionPlugin implements PermissionPluginInterface
{
    /**
     * @var string
     */
    public const KEY = 'CanManageRepresentationOnTradeFairPermissionPlugin';

    /**
     * @return string
     */
    public function getKey(): string
    {
        return static::KEY;
    }
}
