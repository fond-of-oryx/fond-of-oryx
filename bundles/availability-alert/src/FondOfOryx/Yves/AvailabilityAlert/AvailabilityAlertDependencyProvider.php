<?php

namespace FondOfOryx\Yves\AvailabilityAlert;

use FondOfOryx\Yves\AvailabilityAlert\Dependency\Client\AvailabilityAlertToLocaleClientBridge;
use FondOfOryx\Yves\AvailabilityAlert\Dependency\Client\AvailabilityAlertToStoreClientBridge;
use FondOfOryx\Zed\AvailabilityAlert\Business\Model\NotificationPlugins\MailNotificationPlugin;
use Spryker\Yves\Kernel\AbstractBundleDependencyProvider;
use Spryker\Yves\Kernel\Container;

class AvailabilityAlertDependencyProvider extends AbstractBundleDependencyProvider
{
    public const CLIENT_AVAILABILITY_ALERT = 'CLIENT_AVAILABILITY_ALERT';
    public const CLIENT_STORE = 'CLIENT_STORE';
    public const CLIENT_LOCALE = 'CLIENT_LOCALE';
    public const PLUGINS_AVAILABILITY_ALERT_SUBSCRIPTION_REQUEST_EXPANDER = 'PLUGINS_AVAILABILITY_ALERT_SUBSCRIPTION_REQUEST_EXPANDER';
    public const PLUGINS_AVAILABILITY_ALERT_NOTIFICATION = 'PLUGINS_AVAILABILITY_ALERT_NOTIFICATION';

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
        $container = $this->addAvailabilityAlertSubscriptionNotificationPlugins($container);

        return $container;
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addAvailabilityAlertClient(Container $container): Container
    {
        $container[static::CLIENT_AVAILABILITY_ALERT] = function (Container $container) {
            return $container->getLocator()->availabilityAlert()->client();
        };

        return $container;
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addStoreClient(Container $container):Container
    {
        $container[static::CLIENT_STORE] = function (Container $container) {
            return new AvailabilityAlertToStoreClientBridge($container->getLocator()->store()->client());
        };

        return $container;
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addLocaleClient(Container $container):Container
    {
        $container[static::CLIENT_LOCALE] = function (Container $container) {
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
     * @return \FondOfOryx\Yves\AvailabilityAlert\Dependency\Plugin\AvailabilityAlertSubscriptionRequestExpanderPlugin[]
     */
    protected function getAvailabilityAlertSubscriptionRequestExpanderPlugins(): array
    {
        return [];
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addAvailabilityAlertSubscriptionNotificationPlugins(Container $container): Container
    {
        $container[static::PLUGINS_AVAILABILITY_ALERT_NOTIFICATION] = function () {
            return $this->getAvailabilityAlertSubscriptionNotificationPlugins();
        };

        return $container;
    }

    /**
     * @return \FondOfOryx\Yves\AvailabilityAlert\Dependency\Plugin\AvailabilityAlertSubscriptionRequestExpanderPlugin[]
     */
    protected function getAvailabilityAlertSubscriptionNotificationPlugins(): array
    {
        return [
            new MailNotificationPlugin(),
        ];
    }
}
