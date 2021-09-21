<?php

namespace FondOfOryx\Zed\DeliveryDateRestriction;

use FondOfOryx\Zed\DeliveryDateRestriction\Dependency\Facade\DeliveryDateRestrictionToPermissionFacadeBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class DeliveryDateRestrictionDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_PERMISSION = 'FACADE_PERMISSION';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        return $this->addPermissionFacade($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addPermissionFacade(Container $container): Container
    {
        $container[static::FACADE_PERMISSION] = static function (Container $container) {
            return new DeliveryDateRestrictionToPermissionFacadeBridge(
                $container->getLocator()->permission()->facade()
            );
        };

        return $container;
    }
}
