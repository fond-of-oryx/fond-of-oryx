<?php

namespace FondOfOryx\Client\ProductLocaleRestrictionStorage;

use FondOfOryx\Client\ProductLocaleRestrictionStorage\Dependency\Client\ProductLocaleRestrictionStorageToLocaleClientBridge;
use FondOfOryx\Client\ProductLocaleRestrictionStorage\Dependency\Client\ProductLocaleRestrictionStorageToStorageClientBridge;
use FondOfOryx\Client\ProductLocaleRestrictionStorage\Dependency\Service\ProductLocaleRestrictionStorageToSynchronizationServiceBridge;
use Spryker\Client\Kernel\AbstractDependencyProvider;
use Spryker\Client\Kernel\Container;

class ProductLocaleRestrictionStorageDependencyProvider extends AbstractDependencyProvider
{
    /**
     * @var string
     */
    public const CLIENT_LOCALE = 'CLIENT_LOCALE';

    /**
     * @var string
     */
    public const CLIENT_STORAGE = 'CLIENT_STORAGE';

    /**
     * @var string
     */
    public const SERVICE_SYNCHRONIZATION = 'SERVICE_SYNCHRONIZATION';

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    public function provideServiceLayerDependencies(Container $container): Container
    {
        $container = parent::provideServiceLayerDependencies($container);

        $container = $this->addLocaleClient($container);
        $container = $this->addStorageClient($container);
        $container = $this->addSynchronizationService($container);

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addStorageClient(Container $container): Container
    {
        $container[static::CLIENT_STORAGE] = static function (Container $container) {
            return new ProductLocaleRestrictionStorageToStorageClientBridge(
                $container->getLocator()->storage()->client(),
            );
        };

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
            return new ProductLocaleRestrictionStorageToLocaleClientBridge(
                $container->getLocator()->locale()->client(),
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addSynchronizationService(Container $container): Container
    {
        $container[static::SERVICE_SYNCHRONIZATION] = static function (Container $container) {
            return new ProductLocaleRestrictionStorageToSynchronizationServiceBridge(
                $container->getLocator()->synchronization()->service(),
            );
        };

        return $container;
    }
}
