<?php

namespace FondOfOryx\Client\AvailabilityAlert;

use FondOfOryx\Client\AvailabilityAlert\Dependency\Client\AvailabilityAlertToZedRequestBridge;
use Spryker\Client\Kernel\AbstractDependencyProvider;
use Spryker\Client\Kernel\Container;

class AvailabilityAlertDependencyProvider extends AbstractDependencyProvider
{
    /**
     * @var string
     */

    public const CLIENT_ZED_REQUEST = 'CLIENT_ZED_REQUEST';

    /**
     * @var string
     */
    public const PLUGINS_VALIDATION = 'PLUGINS_VALIDATION';

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    public function provideServiceLayerDependencies(Container $container)
    {
        $container = $this->addZedRequestClient($container);
        $container = $this->addAvailabilityAlertValidationPlugins($container);

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addZedRequestClient(Container $container)
    {
        $container[static::CLIENT_ZED_REQUEST] = function (Container $container) {
            return new AvailabilityAlertToZedRequestBridge($container->getLocator()->zedRequest()->client());
        };

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addAvailabilityAlertValidationPlugins(Container $container): Container
    {
        $container[static::PLUGINS_VALIDATION] = function () {
            return $this->getValidationPlugins();
        };

        return $container;
    }

    /**
     * @return array<int, \FondOfOryx\Client\AvailabilityAlertExtension\Dependency\Plugin\ValidationPluginInterface>
     */
    protected function getValidationPlugins(): array
    {
        return [];
    }
}
