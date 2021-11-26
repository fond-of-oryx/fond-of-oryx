<?php

declare(strict_types = 1);

namespace FondOfOryx\Zed\ErpInvoicePermission\Communication\Plugin\Permission;

use Spryker\Shared\PermissionExtension\Dependency\Plugin\PermissionPluginInterface;

class SeeErpInvoicesPermissionPlugin implements PermissionPluginInterface
{
    /**
     * @var string
     */
    public const KEY = 'SeeErpInvoicesPermissionPlugin';

    /**
     * @return string
     */
    public function getKey(): string
    {
        return static::KEY;
    }
}
