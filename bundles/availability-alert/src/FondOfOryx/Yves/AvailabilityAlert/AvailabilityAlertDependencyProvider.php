<?php

namespace FondOfOryx\Yves\AvailabilityAlert;

use Spryker\Yves\Kernel\AbstractBundleDependencyProvider;
use Spryker\Yves\Kernel\Container;

class AvailabilityAlertDependencyProvider extends AbstractBundleDependencyProvider
{
    public const CLIENT_AVAILABILITY_ALERT = 'CLIENT_AVAILABILITY_ALERT';

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    public function provideDependencies(Container $container)
    {
        $container = parent::provideDependencies($container);

        $container = $this->addAvailabilityAlertClient($container);

        return $container;
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addAvailabilityAlertClient(Container $container)
    {
        $container[static::CLIENT_AVAILABILITY_ALERT] = function (Container $container) {
            return $container->getLocator()->availabilityAlert()->client();
        };

        return $container;
    }
}
