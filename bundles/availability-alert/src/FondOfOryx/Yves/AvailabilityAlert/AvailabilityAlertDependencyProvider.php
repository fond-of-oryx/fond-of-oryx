<?php

namespace FondOfOryx\Yves\AvailabilityAlert;

use FondOfOryx\Yves\AvailabilityAlert\Dependency\Client\AvailabilityAlertToLocaleClientBridge;
use FondOfOryx\Yves\AvailabilityAlert\Dependency\Client\AvailabilityAlertToStoreClientBridge;
use Spryker\Yves\Kernel\AbstractBundleDependencyProvider;
use Spryker\Yves\Kernel\Container;

class AvailabilityAlertDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const CLIENT_AVAILABILITY_ALERT = 'CLIENT_AVAILABILITY_ALERT';

    /**
     * @var string
     */
    public const CLIENT_STORE = 'CLIENT_STORE';

    /**
     * @var string
     */
    public const CLIENT_LOCALE = 'CLIENT_LOCALE';

    /**
     * @var string
     */
    public const FORM_FACTORY = 'FORM_FACTORY';

    /**
     * @var string
     */
    public const PLUGINS_AVAILABILITY_ALERT_SUBSCRIPTION_REQUEST_EXPANDER = 'PLUGINS_AVAILABILITY_ALERT_SUBSCRIPTION_REQUEST_EXPANDER';

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    public function provideDependencies(Container $container): Container
    {
        $container = parent::provideDependencies($container);

        $container = $this->addAvailabilityAlertClient($container);
        $container = $this->addStoreClient($container);
        $container = $this->addLocaleClient($container);
        $container = $this->addAvailabilityAlertSubscriptionRequestExpanderPlugins($container);

        return $container;
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addAvailabilityAlertClient(Container $container): Container
    {
        $container[static::CLIENT_AVAILABILITY_ALERT] = static function (Container $container) {
            //@phpstan-ignore-next-line
            return $container->getLocator()->availabilityAlert()->client();
        };

        return $container;
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addStoreClient(Container $container): Container
    {
        $container[static::CLIENT_STORE] = static function (Container $container) {
            return new AvailabilityAlertToStoreClientBridge($container->getLocator()->store()->client());
        };

        return $container;
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addLocaleClient(Container $container): Container
    {
        $container[static::CLIENT_LOCALE] = static function (Container $container) {
            return new AvailabilityAlertToLocaleClientBridge($container->getLocator()->locale()->client());
        };

        return $container;
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addAvailabilityAlertSubscriptionRequestExpanderPlugins(Container $container): Container
    {
        $container[static::PLUGINS_AVAILABILITY_ALERT_SUBSCRIPTION_REQUEST_EXPANDER] = function () {
            return $this->getAvailabilityAlertSubscriptionRequestExpanderPlugins();
        };

        return $container;
    }

    /**
     * @return array<\FondOfOryx\Yves\AvailabilityAlertExtension\Dependency\Plugin\AvailabilityAlertSubscriptionRequestExpanderPlugin>
     */
    protected function getAvailabilityAlertSubscriptionRequestExpanderPlugins(): array
    {
        return [];
    }
}
