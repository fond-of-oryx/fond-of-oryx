<?php

namespace FondOfOryx\Zed\DeliveryDateRestriction\Communication\Plugin\PermissionExtension;

use Spryker\Shared\PermissionExtension\Dependency\Plugin\PermissionPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\DeliveryDateRestriction\Business\DeliveryDateRestrictionFacadeInterface getFacade()
 */
class DefineDeliveryDatePermissionPlugin extends AbstractPlugin implements PermissionPluginInterface
{
    /**
     * @var string
     */
    public const KEY = 'DefineDeliveryDatePermission';

    /**
     * @return string
     */
    public function getKey(): string
    {
        return static::KEY;
    }
}
