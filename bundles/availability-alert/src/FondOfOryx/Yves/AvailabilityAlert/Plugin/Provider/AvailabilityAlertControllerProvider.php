<?php

namespace FondOfOryx\Yves\AvailabilityAlert\Plugin\Provider;

use Silex\Application;
use SprykerShop\Yves\ShopApplication\Plugin\Provider\AbstractYvesControllerProvider;

class AvailabilityAlertControllerProvider extends AbstractYvesControllerProvider
{
    public const ROUTE_AVAILABILITY_ALERT_SUBMIT = 'availability-alert/submit';

    public const ID_ABSTRACT_PRODUCT_REGEX = '[1-9][0-9]*';

    /**
     * @deprecated use FondOfOryx\Yves\AvailabilityAlert\Plugin\Router\AvailabilityAlertControllerProviderPlugin instead
     *
     * @param \Silex\Application $app
     *
     * @return void
     */
    protected function defineControllers(Application $app)
    {
        $allowedLocalesPattern = $this->getAllowedLocalesPattern();

        $this->createController('/{availabilityAlert}/submit/{idProductAbstract}', static::ROUTE_AVAILABILITY_ALERT_SUBMIT, 'AvailabilityAlert', 'Submit', 'index')
            ->assert('availabilityAlert', $allowedLocalesPattern . 'availability-alert|availability-alert')
            ->value('availabilityAlert', 'availability-alert')
            ->assert('idProductAbstract', static::ID_ABSTRACT_PRODUCT_REGEX);
    }
}
