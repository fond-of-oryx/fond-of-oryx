<?php

namespace FondOfOryx\Zed\SplittableCheckout\Communication\Plugin\PermissionExtension;

use Spryker\Shared\PermissionExtension\Dependency\Plugin\PermissionPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\SplittableCheckout\Business\SplittableCheckoutFacadeInterface getFacade()
 */
class PlaceOrderPermissionPlugin extends AbstractPlugin implements PermissionPluginInterface
{
    /**
     * @var string
     */
    public const KEY = 'PlaceOrderPermissionPlugin';

    /**
     * @return string
     */
    public function getKey(): string
    {
        return static::KEY;
    }
}
