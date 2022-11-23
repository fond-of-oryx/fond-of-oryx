<?php

namespace FondOfOryx\Zed\CompanyTypeProductListsRestApi\Communication\Plugin\PermissionExtension;

use Spryker\Shared\PermissionExtension\Dependency\Plugin\PermissionPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

class CanAssignProductListToCustomerPermissionPlugin extends AbstractPlugin implements PermissionPluginInterface
{
    /**
     * @var string
     */
    public const KEY = 'CanAssignProductListToCustomerPermissionPlugin';

    /**
     * Specification:
     * - Defines a permission plugin
     *
     * @api
     *
     * @return string
     */
    public function getKey(): string
    {
        return static::KEY;
    }
}
