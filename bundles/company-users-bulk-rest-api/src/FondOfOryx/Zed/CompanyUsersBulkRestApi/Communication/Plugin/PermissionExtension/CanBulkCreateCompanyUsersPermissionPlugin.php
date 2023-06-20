<?php

declare(strict_types = 1);

namespace FondOfOryx\Zed\CompanyUsersBulkRestApi\Communication\Plugin\PermissionExtension;

use Spryker\Shared\PermissionExtension\Dependency\Plugin\PermissionPluginInterface;

class CanBulkCreateCompanyUsersPermissionPlugin implements PermissionPluginInterface
{
    /**
     * @var string
     */
    public const KEY = 'CanBulkCreateCompanyUsersPermissionPlugin';

    /**
     * @return string
     */
    public function getKey(): string
    {
        return static::KEY;
    }
}
