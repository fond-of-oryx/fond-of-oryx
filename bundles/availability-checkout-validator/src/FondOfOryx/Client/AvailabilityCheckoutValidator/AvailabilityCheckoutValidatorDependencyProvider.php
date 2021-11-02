<?php

namespace FondOfOryx\Client\AvailabilityCheckoutValidator;

use FondOfOryx\Client\AvailabilityCheckoutValidator\Dependency\Client\AvailabilityCheckoutValidatorToZedRequestClientBridge;
use Spryker\Client\Kernel\AbstractDependencyProvider;
use Spryker\Client\Kernel\Container;

class AvailabilityCheckoutValidatorDependencyProvider extends AbstractDependencyProvider
{
    /**
     * @var string
     */
    public const CLIENT_ZED_REQUEST = 'CLIENT_ZED_REQUEST';

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    public function provideServiceLayerDependencies(Container $container): Container
    {
        $container = parent::provideServiceLayerDependencies($container);

        $container = $this->addZedRequestClient($container);

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addZedRequestClient(Container $container): Container
    {
        $container[static::CLIENT_ZED_REQUEST] = static function (Container $container) {
            return new AvailabilityCheckoutValidatorToZedRequestClientBridge(
                $container->getLocator()->zedRequest()->client(),
            );
        };

        return $container;
    }
}
