<?php

namespace FondOfOryx\Zed\CompanyTypeRole\Communication\Plugin\PermissionExtension;

use Spryker\Shared\PermissionExtension\Dependency\Plugin\PermissionPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\CompanyTypeRole\CompanyTypeRoleConfig getConfig()
 * @method \FondOfOryx\Zed\CompanyTypeRole\Business\CompanyTypeRoleFacadeInterface getFacade()
 */
class AssignAdministrationRolePermissionPlugin extends AbstractPlugin implements PermissionPluginInterface
{
    /**
     * @var string
     */
    public const KEY = 'AssignAdministrationRolePermission';

    /**
     * @return string
     */
    public function getKey(): string
    {
        return static::KEY;
    }
}
