<?php

namespace FondOfOryx\Client\ProductLocaleRestrictionSearch;

use FondOfOryx\Client\ProductLocaleRestrictionSearch\Dependency\Client\ProductLocaleRestrictionSearchToLocaleClientBridge;
use Spryker\Client\Kernel\AbstractDependencyProvider;
use Spryker\Client\Kernel\Container;

class ProductLocaleRestrictionSearchDependencyProvider extends AbstractDependencyProvider
{
    public const CLIENT_LOCALE = 'CLIENT_LOCALE';

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    public function provideServiceLayerDependencies(Container $container): Container
    {
        $container = parent::provideServiceLayerDependencies($container);

        $container = $this->addLocaleClient($container);

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addLocaleClient(Container $container): Container
    {
        $container[static::CLIENT_LOCALE] = static function (Container $container) {
            return new ProductLocaleRestrictionSearchToLocaleClientBridge(
                $container->getLocator()->locale()->client()
            );
        };

        return $container;
    }
}
