<?php

namespace FondOfOryx\Zed\CompanyTypeProductListsRestApi\Communication\Plugin\PermissionExtension;

use Spryker\Shared\PermissionExtension\Dependency\Plugin\PermissionPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

class CanAssignProductListToCompanyPermissionPlugin extends AbstractPlugin implements PermissionPluginInterface
{
    /**
     * @var string
     */
    public const KEY = 'CanAssignProductListToCompanyPermissionPlugin';

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
